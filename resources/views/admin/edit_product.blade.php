@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật  sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert" >',$message,'</span>';
        Session::put('message',null);
    }
    ?>                        
                            <div class="position-center">
                                @foreach($edit_product as $row)
                                <form role="form" action="{{URL::to('/update-product/'.$row->product_id)}}" method="post"enctype="multipart/form-data" >
                                  @csrf   
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input required type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$row->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea required style="resize: none" rows="8" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$row->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">nội dung sản phẩm</label>
                                    <textarea required style="resize: none" rows="8" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Mô tả danh mục" >{{$row->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh sản phẩm</label>
                                    <input required type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$row->product_image}}">
                                    <img style="width:120px;height:120spx;" src="{{asset('public/uploads/product/'.$row->product_image)}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm </label>
                                    <input required type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$row->product_price}}">
                                </div>
                                <label for="exampleInputPassword1">Danh mục</label>
                                <select selected name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate as $cate)
                                        
                                <option value="{{$cate->category_id}}" >{{$cate->category_name}}</option>
                                
                                @endforeach
                                </select>
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    @if($row->product_status==0)
                                <option selected value="0" >Ẩn</option>
                                <option value="1">Hiển thị</option>
                                @else
                                <option selected value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                                @endif
                            </select>
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                                @endforeach
                        </div>
                    </section>

            </div>
            @endsection