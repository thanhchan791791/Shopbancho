@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
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
						<tr>
							<form method="post" action="{{URL::to('/check-coupon')}}">
								@csrf
							<td><input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"></td>
							<td><input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="tính mã giảm giá"></td>
</form>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Vui lòng thanh Toán</h3>
			</div>
			<div class="row">
				
				<?php 
				$id = Session::get("customer_id");
				echo $id;
				
				?>
				<div class="col-sm-6">
					<div class="total_area">
					<ul>
							<li>Tổng<span>{{Cart::pricetotal(0).'VNĐ'}}</span></li>
							<li>Thuế <span>{{Cart::tax(0).'VNĐ'}}</span></li>
							<li>Phí vận chuyển<span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total().'VNĐ'}}</span></li>
						</ul>
						
							<?php
                                $customer_id=Session::get('customer_id');
                                $shipping_id=Session::get('shipping_id');
                                if($customer_id && $shipping_id!=NULL){
                                ?>
							<a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a>
                                <?php       
                                }else if ($customer_id!=NULL){
                                ?>
							<a class="btn btn-default check_out" href="{{URL::to('/checkout/'.$id)}}">Thanh toán</a>
                                <?php  
                               } else{
                                    ?>
							<a class="btn btn-default check_out" href="{{URL::to('/login-checkout/'.$id)}}">Thanh toán</a>
                                        <?php
                                }
                                ?>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection 