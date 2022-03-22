@extends('layout')
@section('content')

<style>
	.breadcrumbs .breadcrumb li a:after {
    content: "";
    height: auto;
    width: auto;
    border-width: 8px;
    border-style: solid;
    border-color: transparent transparent transparent #FE980F;
    position: absolute;
    top: 11px;
    left: 96px;
}
</style>

<div class="features_items"><!--features_items-->
@foreach($brand_name as $key => $brname)
		<div class="breadcrumbs" >
            <!-- <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li> -->
				<ol class="breadcrumb">
				<li><a href="#">Thương hiệu</a></li>
                <li class="active" style="color: #fab005;">{{$brname->br_name}}</li>
            </ol>
            </ol>
        </div>
   
    <h2 class="title text-center">{{$brname->br_name}}</h2>
    @endforeach

	@foreach($br_by_id as $key => $pr)
		<a href="{{URL::to('/chitietsanpham/'.$pr->pr_id)}}">
	    <div class="col-sm-4">
		    <div class="product-image-wrapper">
			    <div class="single-products">
					<div class="productinfo text-center">
					    <img src="{{URL::to('public/uploads/product/'.$pr->pr_image)}}" alt="" />
						        <h2>{{number_format($pr->pr_price).' VNĐ'}}</h2>
						        <p>{{($pr->pr_name)}}</p>
						        <a href="{{URL::to('/save-cart')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
					</div>
			    </div>
			    <div class="choose">
				    <ul class="nav nav-pills nav-justified"> </ul>
			    </div>
		    </div>
	    </div>
		</a>				
    @endforeach	
    </div>	
    @endsection					