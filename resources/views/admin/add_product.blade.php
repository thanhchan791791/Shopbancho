@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản phẩm</label>
                                    <input required type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea required style="resize: none" rows="8" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea required style="resize: none" rows="8" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input required type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Hình ảnh sản phẩm">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản phẩm</label>
                                    <input required type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                                </div>
                                 <label for="exampleInputPassword1">Danh mục</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate as $row)
                                <option value="{{$row->category_id}}" >{{$row->category_name}}</option>
                                @endforeach
                                </select>
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0" >Ẩn</option>
                                <option value="1">Hiển thị</option>
                                
                            </select>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            @endsection