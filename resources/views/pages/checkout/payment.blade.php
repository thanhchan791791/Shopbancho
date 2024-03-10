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

			

			

		
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>
            <div class="table-responsive cart_info">
				<?php
				$content=Cart::content();
				// echo '<pre>';
				// print_r($content);
				// echo '<pre>';
				?>

			<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img width="100px" height="100px;" src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Mã sản phẩm: {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URl::to('/update-cart-quantity/'.$v_content->rowId)}}" method="post">
										@csrf
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
									<input type="submit" value="cập nhật" name="update_qty" class="btn btn-default btn-sm">
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									</form>
								</div>
							</td>
							<td class="cart_total">
								
								<p class="cart_total_price"><?php
								$subtotal=$v_content->price*$v_content->qty;
								echo number_format($subtotal).'VNĐ';
								?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
			<h4 style="margin:40px 0;front-size:20px">Chọn hình thức thanh toán</h4>
            <form action="{{URL::to('/order-place')}}" method="post">
                @csrf
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
					</span>
					<button type="submit"  name="send-payment" class="btn btn-default btn-sm">Đặt hàng</button>

					<!-- <span>
						<label><input type="checkbox"> Paypal</label>
					</span> -->
				</div>
</form>
		</div>
	</section> <!--/#cart_items-->

@endsection