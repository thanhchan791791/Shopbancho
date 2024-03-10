<?php

namespace App\Http\Controllers;
use Redirect;

use Illuminate\Http\Request;
use DB;	
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirects;
Session_start();

class ProductController extends Controller
{
	public function authlogin(){
		$admin_id=session::get('admin_id');
		if($admin_id){
			return Redirect::to('dashboard');
}else{
	return Redirect::to('admin')->send();

}
}
     public function all_product(){
		$this->authlogin();
 		// $all_category_product = DB::table('tbl_category_product')->select('*');
   //      $all_category_product = $all_category_product->get();

   $all_product=  DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->orderby('tbl_product.product_id','desc')->get();

   //      return view('admin.all_category_product', compact('all_category_product'));
   	// $all_product=  DB::table('tbl_product')->get();
	$manager_product= view('admin.all_product')-> with('all_product',$all_product);
	return view('admin-layout')->with('admin.all_product',$manager_product);
   }
   public function add_product(){
	$this->authlogin();

   		$cate=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
   			

   		return view('admin.add_product')->with('cate',$cate);	
   }
   public function save_product(Request $Request){
	$this->authlogin();

   		$data= array();
   		$data['product_name']=$Request->product_name;
   		$data['product_desc']=$Request->product_desc;
   		$data['product_content']=$Request->product_content;
   		
   		$data['product_price']=$Request->product_price;
   		$data['category_id']=$Request->product_cate;
   		$data['product_status']=$Request->product_status;
   		$get_image=$Request->file('product_image');
   		if($get_image){
			$this->authlogin();

   			$get_name_image=$get_image->getClientOriginalName();
   			$name_image=current(explode('.', $get_name_image));
   			$new_image=$name_image.	rand(0,99).'.'.$get_image->getClientOriginalExtension();
   			$get_image->move('public/uploads/product',$new_image);
   			$data['product_image']=$new_image;
   			print_r($data);
			DB::table('tbl_product')->insert($data);
   			session::put('message','Thêm sản phẩm thành công');
   			return Redirect::to('/add-product');
   		}else{
   			$data['product_image']= '';
   			DB::table('tbl_product')->insert($data);
   			session::put('message','Thêm sản phẩm thành công');
   			return Redirect::to('/add-product');
   			
   		 }

			  
   }
   public function active($product_id){
	$this->authlogin();

   		DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
   		session::put('message','không kích hoạt sản phẩm thành công');
   		return Redirect::to('/all-product');
   		
   }
    public function unactive($product_id){
		$this->authlogin();

   		DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
   		session::put('message','kích hoạt sản phẩm thành công');
   		return Redirect::to('/all-product');
   		
   }
   public function edit_product($product_id){
	$this->authlogin();

			$cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
   			$edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
   			$manager_product= view('admin.edit_product')->with('edit_product',$edit_product)->with("cate",$cate);
   			return view('admin-layout')->with('admin.edit_product',$manager_product);
      
   }
  
    public function update_product(Request $Request,$product_id){
		$this->authlogin();

   		$data= array();
   		$data['product_name']=$Request->product_name;
		$data['product_desc']=$Request->product_desc;
		$data['product_content']=$Request->product_content;
		$data['product_price']=$Request->product_price;
		$data['category_id']=$Request->product_cate;
   		$data['product_status']=$Request->product_status;
		   $get_image=$Request->file('product_image');
   		if($get_image){
   			$get_name_image=$get_image->getClientOriginalName();
   			$name_image=current(explode('.', $get_name_image));
   			$new_image=$name_image.	rand(0,99).'.'.$get_image->getClientOriginalExtension();
   			$get_image->move('public/uploads/product',$new_image);
   			$data['product_image']=$new_image;
   		DB::table('tbl_product')->where('product_id',$product_id)->update($data);
   		session::put('message','Cập nhật sản phẩm thành công');
   		return Redirect::to('/all-product');
   } else {
	$data['product_image']= '';
	DB::table('tbl_product')->where('product_id',$product_id)->update($data);
	session::put('message','Cập nhật sản phẩm thành công');
	return Redirect::to('/all-product');
   }
   }
    public function delete_product($product_id){
		$this->authlogin();

   	DB::table('tbl_product')->where('product_id',$product_id)->delete();
   		session::put('message','Xóa sản phẩm thành công');
   		return Redirect::to('/all-product');
   }
   public function test(){
	return view('testslider');
   }
   //end admin page
   public function details_product($product_id){
	$cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
	$all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
	$details_product= DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_product.product_id',$product_id)->get();	
	foreach(@$details_product as $details){
	$category_id= $details->category_id;
	}
	$related_product= DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();	

	return view('pages.sanpham.product-detail')->with('cate_product',$cate_product)->with('all_product',$all_product)->with('details_product',$details_product)->with('related_product',@$related_product);
		}
   }

