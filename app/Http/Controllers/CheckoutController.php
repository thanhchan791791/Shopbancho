<?php

namespace App\Http\Controllers;
use Redirect;
use Cart;
use Illuminate\Http\Request;
use DB;	
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirects;
Session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
            return view('pages.checkout.login-checkout')->with('cate_product',$cate_product)->with('all_product',$all_product);
    }
    public function add_customer(Request $request){
            $data=array();
            $data['customer_name']=$request->customer_name;
            $data['customer_email']=$request->customer_email;
            $data['customer_password']=$request->customer_password;
            $data['customer_phone']=$request->customer_phone; 

            $customer_id= DB::table('tbl_customer')->InsertGetId($data);

            Session::put('customer_id',$customer_id);
            Session::put('customer_name',$request->customer_name);
            return Redirect('/');
    }
    public function checkout($customer_id){
        $infor=DB::table('tbl_customer')->where('customer_id',$customer_id)->orderby('customer_id','desc')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
        return view('pages.checkout.checkout')->with('infor',$infor)->with('cate_product',$cate_product)->with('all_product',$all_product);
        // echo $all_product->product_id;
    }

    public function save_checkout_customer(Request $request){
        $data=array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_notes']=$request->shipping_notes; 
        $data['shipping_address']=$request->shipping_address; 
        $shipping_id= DB::table('tbl_shipping')->InsertGetId($data);
        Session::put('shipping_id',$shipping_id);
            return Redirect('/payment');
    }
    public function check_login(Request $Request){
		$email_account=$Request->email_account;
		$password_account=($Request->password_account);
		
		$result= DB::table('tbl_customer')->where('customer_email',$email_account)->where('customer_password',$password_account)->first();
       
		if($result){
			Session::put('customer_name',$result->customer_name);
			Session::put('customer_id',$result->customer_id);
			return Redirect::to('/');

		}else{
			Session::put('message','Tài khoản hoặc mật khẩu không đúng');
			 return Redirect::to('/login-checkout');
		}
		
    }
    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/');
    }
    public function payment(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        return view('pages.checkout.payment')->with('cate_product',$cate_product);
    }
    public function order_place(Request $request){
        
       //insert payment_method
        $data=array();
        $data['payment_method']=$request->payment_option;
        $data['payment_status']='đang chờ xử lí';
        $payment_id= DB::table('tbl_payment')->InsertGetId($data);

        //insert order
        $order_data=array();
        $order_data['customer_id']=Session::get('customer_id');
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']=Cart::total();
        $order_data['order_status']='đang chờ xử lí';
        $order_id= DB::table('tbl_order')->InsertGetId($order_data);
        //insert order_details
        $content=Cart::content();
        foreach($content as $v_content){
        $order_d_data=array();
        $order_d_data['order_id']=$order_id;
        $order_d_data['product_id']=$v_content->id;
        $order_d_data['product_name']=$v_content->name;
        $order_d_data['product_price']=$v_content->price;
        $order_d_data['product_quantity']=$v_content->qty;
        DB::table('tbl_orderdetails')->insert($order_d_data);
        }
           if($data['payment_method']==1){
            echo 'Thanh toán thẻ';
           }else{
            Cart::destroy();
            $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

            return view('pages.checkout.hand-cash')->with('cate_product',$cate_product);
           }
        



        
      
            // return Redirect('/payment');
        }
    public function manage_order(){
        $this->authlogin();
 

   $all_order=  DB::table('tbl_order')->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')->select('tbl_order.*','tbl_customer.customer_name')->orderby('tbl_order.order_id','desc')->get();

 
   	// $all_product=  DB::table('tbl_product')->get();
	$manager_order= view('admin.manage_order')-> with('all_order',$all_order);
	return view('admin-layout')->with('admin.manage_order',$manager_order);
        
    }
    public function authlogin(){
		$admin_id=session::get('admin_id');
		if($admin_id){
			return Redirect::to('dashboard');
}else{
	return Redirect::to('admin')->send();

}

    
}
public function view_order($orderId){
    $this->authlogin();
    // $all_category_product = DB::table('tbl_category_product')->select('*');
//      $all_category_product = $all_category_product->get();

$order_by_id=  DB::table('tbl_order')->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
->join('tbl_orderdetails','tbl_order.order_id','=','tbl_orderdetails.order_id')
->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_orderdetails.*')->where('tbl_order.order_id',$orderId)->first();
$orderdetails=DB::table('tbl_orderdetails')->where('order_id',$orderId)->get();

print_r($orderdetails);
//      return view('admin.all_category_product', compact('all_category_product'));
  // $all_product=  DB::table('tbl_product')->get();
$manager_order= view('admin.view_order')-> with('order_by_id',$order_by_id)->with('orderdetails',$orderdetails);
return view('admin-layout')->with('admin.view_order',$manager_order);
// }
}
public function delete_order($order_id){
    DB::table('tbl_order')->where('order_id',$order_id)->delete();
   		session::put('message','Xóa đơn hàng thành công');
   		return Redirect::to('/manage-order');


}
}
