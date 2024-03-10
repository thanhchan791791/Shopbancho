<?php

namespace App\Http\Controllers;
use Redirect;

use Illuminate\Http\Request;
use DB;	
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirects;
Session_start();
class CategoryProduct extends Controller
{
	public function authlogin(){
		$admin_id=session::get('admin_id');
		if($admin_id){
			return Redirect::to('dashboard');
}else{
	return Redirect::to('admin')->send();

}
}
   public function all_category_product(){
      $this->authlogin();
   	$all_category_product=  DB::table('tbl_category_product')->get();
	$manager_category_product= view('admin.all_category_product')-> with('all_category_product',$all_category_product);
	return view('admin-layout')->with('admin.all_category_product',$manager_category_product);
   }
   public function add_category_product(){
	$this->authlogin();

   		return view('admin.add_category_product');
   }
   public function save_category_product(Request $Request){
	$this->authlogin();

   		$data= array();
   		$data['category_name']=$Request->category_product_name;
   		$data['category_desc']=$Request->category_product_desc;
   		$data['category_status']=$Request->category_product_status;
   			print_r($data);
   		 DB::table('tbl_category_product')->insert($data);
   			session::put('message','Thêm danh mục sản phẩm thành công');
   			return Redirect::to('/add-category-product');

			  
   }
   public function active($category_product_id){
	$this->authlogin();

   		DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
   		session::put('message','không kích hoạt danh mục sản phẩm thành công');
   		return Redirect::to('/all-category-product');
   		
   }
    public function unactive($category_product_id){
		$this->authlogin();

   		DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
   		session::put('message','kích hoạt danh mục sản phẩm thành công');
   		return Redirect::to('/all-category-product');
   		
   }
   public function edit_category_product($category_product_id){
	$this->authlogin();

   			$edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
   			$manager_category_product= view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
   			return view('admin-layout')->with('admin.edit_category_product',$manager_category_product);
      
   }
  
    public function update_category_product(Request $Request,$category_product_id){
		$this->authlogin();

   		$data= array();
   		$data['category_name']=$Request->category_product_name;
   		$data['category_desc']=$Request->category_product_desc;
   		DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
   		session::put('message','Cập nhật danh mục sản phẩm thành công');
   		return Redirect::to('/all-category-product');
   }
    public function delete_category_product($category_product_id){
		$this->authlogin();

   	DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
   		session::put('message','Xóa danh mục sản phẩm thành công');
   		return Redirect::to('/all-category-product');
   }
   //end function adminpage
   public function show_category_home($category_id){
	$cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
	$all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();	
	$category_by_id=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();		
	return view('pages.category.show_category')->with('cate_product',$cate_product)->with('category_by_id',$category_by_id);
		}
   }
   
 
