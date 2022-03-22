<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | MintueStore</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 833 125 201</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> Toai.72429@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}"><img src="{{('public/frontend/images/logo.png')}}"
                                    style="width:400px;" alt="" /></a>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">


                                <li><a href="cart.html"><i class="fa fa-star"></i> Yêu thích</a></li>

                                <?php
									$customer_id = Session::get('ctm_id'); 
									$shipping_id = Session::get('sp_id'); 
									if ($customer_id!=null && $shipping_id=null){

								?>
                                <li><a href="{{URL::to('/check-out')}}"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                                </li>
                                <?php
									}elseif($customer_id!=null && $shipping_id!=null){
								?>
                                <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a>
                                </li>

                                <?php
									}else {
								?>
                                <li><a href="{{URL::to('/login-check-out')}}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a>
                                </li>
                                <?php
									}
								?>

                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                                </li>
                                <?php
									$customer_id = Session::get('ctm_id'); 
									if ($customer_id!=null){
								?>
                                <li><a href="{{URL::to('/logout-check-out')}}"><i class="fa fa-lock"></i> Đăng xuất</a>
                                </li>
                                <?php
									}else{
								?>
                                <li><a href="{{URL::to('/login-check-out')}}"><i class="fa fa-lock"></i> Đăng nhập</a>
                                </li>
                                <?php
									}
								?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>

                                <li><a href="#">Tin tức</a> </li>
                                <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" method="post">
                            {{csrf_field()}}
                            <div class="search_box pull-right">
                                <input type="text" name="keywords_submit" style="width: 200px; border-radius: 2px;"
                                    placeholder="Tìm kiếm sản phẩm" />
                                <input type="submit" name="search_items" class="btn btn-warning btn-sm"
                                    style="width: 80px; margin-bottom: 1px; border: 1px solid #80ffff"
                                    value="Tìm kiếm" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->
    <div class="col-sm-9" style="margin-left:300px;">

        @yield('content1')

    </div>
    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>MINTUE</span>-Store</h1>
                                    <h2>Đây là nơi</h2>
                                    <p></p>
                                    <button type="button" class="btn btn-default get">Mua ngay sản phẩm của chúng
                                        tôi</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/slider1.png')}}" class="girl img-responsive"
                                        alt="" />
                                    <img src="{{('public/frontend/images/km1.png')}}"
                                        style="width: 20%; margin-right: -150px;" class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>MINTUE</span>-Store</h1>
                                    <h2>Mang lại cho bạn</h2>
                                    <p></p>
                                    <button type="button" class="btn btn-default get">Mua ngay sản phẩm của chúng
                                        tôi</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/slider2.png')}}" style="width: 99%"
                                        class="girl img-responsive" alt="" />
                                    <img src="{{('public/frontend/images/km1.png')}}"
                                        style="width: 20%; margin-right: -150px;" class="pricing" alt="" />
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>MINTUE</span>-Store</h1>
                                    <h2>Thiết bị giải trí đỉnh cao</h2>
                                    <p></p>
                                    <button type="button" class="btn btn-default get">Mua ngay sản phẩm của chúng
                                        tôi</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{('public/frontend/images/slider3.png')}}"
                                        style="width: 58%; margin-left: 120px;" class="girl img-responsive" alt="" />
                                    <img src="{{('public/frontend/images/km2.png')}}"
                                        style="width: 20%; margin-right: -120px;  margin-top: 60px" class="pricing"
                                        alt="" />
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">


                    <div class="brands_products" style="padding-bottom: 20px;">

                        <!--category-productsr-->
                        <h2>Danh mục</h2>
                        @foreach($category as $key =>$cgr)
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::to('/danhmucsanpham/'.$cgr->cgr_id)}}"> <span
                                            class="pull-right"></span>{{$cgr->cgr_name}}</a></li>
                            </ul>
                        </div>

                        @endforeach
                    </div>

                    <!--/category-products-->


                    <div class="brands_products" style="padding-bottom: 20px;">
                        <!--brands_products-->
                        <h2>Thương hiệu</h2>
                        @foreach($brand as $key =>$br)
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::to('/thuonghieusanpham/'.$br->br_id)}}"> <span
                                            class="pull-right"></span>{{$br->br_name}}</a></li>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    <!--/brands_products-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">

                @yield('content')

            </div>
        </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>MINTUE</span>-store</h2>
                            <p>Mang đến giải trí đích thực!</p>
                        </div>
                    </div>
                    <div class="col-sm-7">

                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{('public/frontend/images/map.png')}}" alt="" />
                            <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Viet Nam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Sản phẩm</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <!-- <li><a href="#">Máy chơi game</a></li>
                                <li><a href="#">Điện thoại</a></li>
                                <li><a href="#">Máy tính bảng</a></li>
                                <li><a href="#">Cáp - Sạc</a></li>
                                <li><a href="#">Phụ kiện</a></li> -->

                                @foreach($category as $key =>$cgr)
                       
                                <li><a href="{{URL::to('/danhmucsanpham/'.$cgr->cgr_id)}}"> 
                                    {{$cgr->cgr_name}}</a></li>
                          
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Thông tin </h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Nhận thông tin</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Địa chỉ email của bạn"  style="color: #000000;"/>
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p> . . . . .<br />. . .<br />.</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2022 MINTUE-store Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="#">Mintue</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.add-to-cart').click(function () {
                var id = $(this).data('id_product');
                var productid_hidden = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/save-cart ')}}',
                    method: 'POST',
                    data: {
                        productid_hidden: productid_hidden,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        qty: qty,
                        _token: _token
                    },
                    success: function (data) {

                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Tiếp tục xem",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function () {
                                window.location.href = "{{url('/show-cart')}}";
                            });
                        // alert(data);
                    }

                });
            });
        });

    </script>


</body>

</html>
