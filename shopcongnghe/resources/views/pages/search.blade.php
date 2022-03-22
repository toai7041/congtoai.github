@extends('layout')
@section('content')

<div class="features_items">
    <!--features_items-->

    <h2 class="title text-center">Kết quả tìm kiếm</h2>


    @foreach($search_product as $key => $pr)


    <a href="{{URL::to('/chitietsanpham/'.$pr->pr_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$pr->pr_image)}}" alt="" />
                        <h2>{{number_format($pr->pr_price).' VNĐ'}}</h2>
                        <p>{{($pr->pr_name)}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                            hàng</a>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>

    @endforeach
</div>

@endsection
