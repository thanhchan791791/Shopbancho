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
						<?php 
                        print_r(Session::get('cart'));
                      s
                        ?>
						<tr>
							<td class="cart_product">
								<a href=""><img width="100px" height="100px;" src="" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>Mã sản phẩm: </p>
							</td>
							<td class="cart_price">
								<p></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="" method="post">
										@csrf
									<input class="cart_quantity_input" type="text" name="quantity" value="" autocomplete="off" size="2">
									<input type="submit" value="cập nhật" name="update_qty" class="btn btn-default btn-sm">
									<input type="hidden" value="" name="rowId_cart" class="form-control">
									</form>
								</div>
							</td>
							<td class="cart_total">
								
								<p class="cart_total_price"></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
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
				
				
				<div class="col-sm-6">
					<div class="total_area">
					<ul>
							<li>Tổng<span></span></li>
							<li>Thuế <span></span></li>
							<li>Phí vận chuyển<span>Free</span></li>
							<li>Thành tiền <span></span></li>
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
							<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                                <?php  
                               } else{
                                    ?>
							<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                                        <?php
                                }
                                ?>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection 