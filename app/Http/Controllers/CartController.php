<?php

namespace App\Http\Controllers;
use Redirect;

use Illuminate\Http\Request;
use DB;	
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirects;
Session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
        $product_id= $request->productid_hidden;
        $quantity= $request->qty;

        $cart_details=DB::table('tbl_product')->where('product_id',$product_id)->first();
       
        $data=array();
        $data['id']=$product_id;
        $data['qty']=$quantity;
        $data['name']=$cart_details->product_name;
        $data['price']=$cart_details->product_price;
        $data['weight']='123';

        $data['options']['image']=$cart_details->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10);
        return Redirect::to('/show-cart');
    //    Cart::destroy();
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }  
    public function gio_hang(){
          // Cart::destroy();

          $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

          return view('pages.cart.cart_ajax ')->with('cate_product',$cate_product);
          
      }
    
    public function show_cart(){
        // Cart::destroy();

        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        return view('pages.cart.show-cart')->with('cate_product',$cate_product);
        
    }
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');

    }
    public function update_cart_quantity(Request $request){
            $rowId=$request->rowId_cart;
            $qty=$request->quantity;   
            Cart::update($rowId,$qty);
            return Redirect::to('/show-cart');
        }
        public function check_coupon(Request $request){
            $data=$request->all();
            print_r($data);

        }
    }
