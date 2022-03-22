@extends('layout')
@section('content')

<div class="features_items">
    <!--features_items-->

    <h2 class="title text-center">Sản phẩm mới</h2>


    @foreach($all_product as $key => $pr)


    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">

                    <form>
                        @csrf
                        <input type="hidden" value="{{$pr->pr_id}}" class="cart_product_id_{{$pr->pr_id}}">
                        <input type="hidden" value="{{$pr->pr_name}}" class="cart_product_name_{{$pr->pr_id}}">
                        <input type="hidden" value="{{$pr->pr_image}}" class="cart_product_image_{{$pr->pr_id}}">
                        <input type="hidden" value="{{$pr->pr_price}}" class="cart_product_price_{{$pr->pr_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$pr->pr_id}}">

                        <a href="{{URL::to('/chitietsanpham/'.$pr->pr_id)}}">

                            <img src="{{URL::to('public/uploads/product/'.$pr->pr_image)}}" alt="" />
                            <h2>{{number_format($pr->pr_price).' VNĐ'}}</h2>
                            <p>{{($pr->pr_name)}}</p>

                        </a>
                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$pr->pr_id}}"
                            name="add-to-cart">Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-heart"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>




    @endforeach
</div>

@endsection
