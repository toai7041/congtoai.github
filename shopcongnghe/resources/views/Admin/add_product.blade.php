@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class = "text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Danh mục sản phẩm </label>
                                    <select name="category_product" class="form-control input-sm m-bot15">
                                        
                                        @foreach($cgr_product as $key => $cgr)
                                            <option value="{{$cgr->cgr_id}}">{{$cgr->cgr_name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Thương hiệu </label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                        @foreach($br_product as $key => $br)
                                            <option value="{{$br->br_id}}">{{$br->br_name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="pr_image" class="form-control" id="exampleInputEmail1" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu sắc sản phẩm</label>
                                    <input type="text" name="product_color" class="form-control" id="exampleInputEmail1" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" name="product_desc" class="form-control" id="ckeditor1" placeholder="Mô tả"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" name="product_content" class="form-control" id="ckeditor2" ></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Trạng thái </label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hiển thị </option>
                                        <option value="0">Ẩn</option>
                                        
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection