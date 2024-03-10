@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản phẩm mới nhất</h2>
                        @foreach($all_product as $all_product)
                       
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                <a href="{{URL::to('/chitietsanpham/'.$all_product->product_id)}}" >
                                        <div class="productinfo text-center">
                                            <from>
                                                @csrf
                                                <input type="hidden" name="" value="{{$all_product->product_id}}" class="cart_product_id_{{$all_product->product_id}}">
                                                <input type="hidden" name="" value="1" class="cart_product_qty_{{$all_product->product_id}}">
                                                <input type="hidden" name="" value="{{$all_product->product_name}}" class="cart_product_name_{{$all_product->product_id}}">
                                                <input type="hidden" name="" value="{{$all_product->product_price}}" class="cart_product_price_{{$all_product->product_id}}">
                                                <input type="hidden" name="" value="{{$all_product->product_image}}" class="cart_product_image_{{$all_product->product_id}}">

                                        
                                            <img style="height:300px;" src="{{URL::to('public/uploads/product/'.$all_product->product_image)}}" alt="" />
                                            <h2>{{number_format($all_product->product_price).'VND'}}</h2>
                                            <p>{{$all_product->product_name}}</p>

                                            <!-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> -->
                                            <button class="btn btn-default add-to-cart" data-id_product="{{$all_product->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>                                        </div>
</form>
                                </div>
                                </a>
                                <!-- <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>

                        @endforeach
                       
                        
                    </div><!--features_items-->
                     
@endsection
<script type="text/javascript">
$(document).ready(function(){

swal("Hello world!");

});
</script>