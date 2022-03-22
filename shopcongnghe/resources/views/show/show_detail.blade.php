@extends('layout')
@section('content')

@foreach($detail_product as $key =>$detail)
<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('/public/uploads/product/'.$detail->pr_image)}}" alt="" />
            <h3></h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <a href=""><img src="{{URL::to('/public/uploads/product/'.$detail->pr_image)}}"
                            style="width:80px;height:90px;" alt=""></a>
                    <a href=""><img src="{{URL::to('/public/uploads/product/'.$detail->pr_image)}}"
                            style="width:80px;height:90px;" alt=""></a>
                    <a href=""><img src="{{URL::to('/public/uploads/product/'.$detail->pr_image)}}"
                            style="width:80px;height:90px;" alt=""></a>


                </div>

            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$detail->pr_name}}</h2>
            <img src="images/product-details/rating.png" alt="" />

            <form action="{{URL::to('/save-cart')}}" method="post">
                {{csrf_field()}}

                <span>
                    <span>{{number_format($detail->pr_price)." VNĐ"}}</span>
                </span>
                <span>
                    <label>Số lượng:</label>
                    <input type="number" name="qty" min="1" value="1" />
                    <input name="productid_hidden" type="hidden" value="{{$detail->pr_id}}" />
                    <button type="submit" name="" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </span>
            </form>
            <p><b>Tình trạng: </b> Còn hàng</p>
            <p><b>Danh mục: </b>{{$detail->cgr_name}}</p>
            <p><b>Thương hiệu: </b> {{$detail->br_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->

<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
            <div class="product-information">
                <textarea style="resize: none" rows="18" name="product_desc" class="form-control" id="ckeditor3">  {{$detail->pr_desc}} </textarea>
            </div>
        </div>

        <div class="tab-pane fade" id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>15.01.2022</a></li>
                </ul>
                <p></p>
                <p><b>Gửi đánh giá</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Họ tên" />
                        <input type="email" placeholder="Email" />
                    </span>
                    <textarea style="resize: none" rows="14" name=""></textarea>
                    <b>Đánh giá </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Xác nhận
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
@endforeach
<!--recommended_items-->

<div class="recommended_items">
    <h2 class="title text-center">Sản phẩm tương tự</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <a class="left recommended-item-control" style="z-index:100;" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>

            <!-- <div class="item active">
                @foreach($related_product as $key => $related)
                    <a href="{{URL::to('/chitietsanpham/'.$related->pr_id)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{URL::to('/public/uploads/product/'.$related->pr_image)}}" alt="" />
                                        <h2>{{number_format($related->pr_price)." VNĐ"}}</h2>
                                        <p>{{$related->pr_name}}</p>
                                        <a href="{{URL::to('/save-cart')}}" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div> -->

            @foreach($test as $key => $related_product)
            <div class="item {{$key == 0 ? 'active' : ''}}">
                @foreach($related_product as $key => $related)
                    <a href="{{URL::to('/chitietsanpham/'.$related->pr_id)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{URL::to('/public/uploads/product/'.$related->pr_image)}}" alt="" />
                                        <h2>{{number_format($related->pr_price)." VNĐ"}}</h2>
                                        <p>{{$related->pr_name}}</p>
                                        <a href="{{URL::to('/save-cart')}}" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endforeach

            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
    </div>
</div>

@endsection
