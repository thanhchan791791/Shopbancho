@extends('welcome')
@section('content')
<script type="text/javascript">
      function validateForm() {
  let x = document.forms["myForm"]["email_account"].value;
  if (x == "") {
    alert("vui lòng nhập email");
    return false;
  }
}
    </script>
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
					<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert" >',$message,'</span>';
        Session::put('message',null);
    }
    ?>  
						<h2>Đăng nhập tài khoản</h2>
						<form name="myForm" action="{{URL::to('/check-login')}}" onsubmit="return validateForm()" method="post">
							@csrf
							<input required type="text" name="email_account" placeholder="Tài khoản" />
							<input required type="password" name="password_account" placeholder="password" />
							
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí</h2>
						<form action="{{URL::to('/add-customer')}}" method="post">
                            @csrf
							<input required type="text" name="customer_name" placeholder="Họ và tên"/>
							<input required type="email" name="customer_email" placeholder="Email"/>
							<input required type="password" name="customer_password" placeholder="Mật khẩu"/>
                            <input required type="password" name="customer_phone" placeholder="Phone"/>

							<button type="submit" class="btn btn-default">Đăng kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	


@endsection