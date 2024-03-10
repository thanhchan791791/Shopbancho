@extends('welcome')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			

			<div class="register-req">
				<p>Làm ơn đăng nhập hoặc đăng kí để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								@foreach($infor as $infor)
								<form action="{{URL::to('/save-checkout-customer')}}" method="post">
                                    @csrf
									<input type="text" name="shipping_email" value="{{$infor->customer_email}}" placeholder="Email*">
									<input type="text" name="shipping_name" placeholder="Họ và tên"
									value="{{$infor->customer_name}}">
									<input type="text" name="shipping_address" required placeholder="Địa chỉ *">
									<input type="text" name="shipping_phone" value="{{$infor->customer_phone}}" placeholder="Phone">
									<h3>Ghi chú đơn hàng của bạn</h3>
									<input name="shipping_notes" value="."  placeholder="Ghi chú đơn hàng của bạn"   rows="10"/>

									<input type="submit" value="Gui" name="send_order" class="btn btn-default btn-sm">

								</form>
							@endforeach
							</div>
							
						</div>
					</div>
					
					</div>					
				</div>
			</div>
			

			
			
			
	</section> <!--/#cart_items-->

@endsection