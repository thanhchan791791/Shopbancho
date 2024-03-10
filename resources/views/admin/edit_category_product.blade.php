@extends('admin-layout')
@section('admin-content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
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
                                @foreach($edit_category_product as $row)
                                <form role="form" action="{{URL::to('/update-category-product/'.$row->category_id)}}" method="post">
                                  @csrf   
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input required type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$row->category_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea required style="resize: none" rows="8" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"  >{{$row->category_desc}}</textarea>
                                </div>
                                
                               
                                
                            </select>
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                                @endforeach
                        </div>
                    </section>

            </div>
            @endsection