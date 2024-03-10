<?php

namespace App\Http\Controllers;
use Redirect;

use Illuminate\Http\Request;
use DB;	
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirects;
Session_start();

class HomeController extends Controller
{
    public function test(){
        return view('test');
    }
    public function index(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
    	return view('pages.home')->with('cate_product',$cate_product)->with('all_product',$all_product);
    }
    public function tim_kiem(Request $request){
        $keywords=$request->keywords_submit;
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$search_product=DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        
        return view('pages.sanpham.search')->with('cate_product',$cate_product)->with('search_product',$search_product);
    }
}
