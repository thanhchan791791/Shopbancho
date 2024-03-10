@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Danh mục sản phẩm</h2>
                        @foreach($category_by_id as $all_product)
                        <a href="{{URL::to('/chitietsanpham/'.$all_product->product_id)}}" >
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">

                                        <div class="productinfo text-center">
                                            <img style="height:300px;" src="{{URL::to('public/uploads/product/'.$all_product->product_image)}}" alt="" />
                                            <h2>{{number_format($all_product->product_price).'VND'}}</h2>
                                            <p>{{$all_product->product_name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        </div>
                                            <!-- <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>{{number_format($all_product->product_price).'VND'}}</h2>
                                                    <p>{{$all_product->product_name}}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                                </div>
                                            </div> -->
                                </div>
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