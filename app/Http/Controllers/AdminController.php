<?php

namespace App\Http\Controllers;
use Redirect;

use Illuminate\Http\Request;
use DB;	
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirects;



Session_start();
class AdminController extends Controller
{
	public function authlogin(){
			$admin_id=session::get('admin_id');
			if($admin_id){
				return Redirect::to('dashboard');
	}else{
		return Redirect::to('admin')->send();

	}
}
    public function index1(){
    	return view('admin-login');
    }
    public function showdashboard(){
		$this-> authlogin();
    	if(session::get('admin_id')){
    	return view('admin.dashboard');
    }else{
    	return Redirect::to('/admin');
    }
    }
   public function dashboard(Request $Request){
		$admin_email=$Request->admin_email;
		$admin_password=($Request->admin_password);
		
		$result= DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
		if($result){
			Session::put('admin_name',$result->admin_name);
			Session::put('admin_id',$result->admin_id);
			return Redirect::to('/dashboard');

		}else{
			Session::put('message','Tài khoản hoặc mật khẩu không đúng');
			 return Redirect::to('/admin');
		}
		
    }
    
    public function logout(){
    	session::put('admin_name',null);
    	session::put('admin_id',null);
    	return Redirect::to('/admin');
    }
}