@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            @foreach($edit_product as $key => $pr)
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class = "text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-product/'.$pr->pr_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pr->pr_name}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Danh mục sản phẩm </label>
                                    <select name="category_product" class="form-control input-sm m-bot15">
                                        
                                        @foreach($cgr_product as $key => $cgr)
                                            @if($cgr->cgr_id == $pr->cgr_id)
                                            <option selected value="{{$cgr->cgr_id}}">{{$cgr->cgr_name}}</option>

                                            @else
                                            <option value="{{$cgr->cgr_id}}">{{$cgr->cgr_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Thương hiệu </label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                        @foreach($br_product as $key => $br)
                                            @if($br->br_id == $pr->br_id)
                                                <option selected value="{{$br->br_id}}">{{$br->br_name}}</option>

                                            @else
                                                <option value="{{$br->br_id}}">{{$br->br_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pr->pr_price}}" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="pr_image" class="form-control" id="exampleInputEmail1" value="{{$pr->pr_image}}">
                                    <img src="{{URL::to('public/uploads/product/'.$pr->pr_image)}}" height ="100" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu sắc sản phẩm</label>
                                    <input type="text" name="product_color" class="form-control" id="exampleInputEmail1" value="{{$pr->pr_color}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" name="product_desc" class="form-control" id="ckeditor2" >{{$pr->pr_desc}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" name="product_content" class="form-control" id="exampleInputPassword1" >{{$pr->pr_content}}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Trạng thái </label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hiển thị </option>
                                        <option value="0">Ẩn</option>
                                        
                                    </select>
                                </div>
                                
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>

@endsection