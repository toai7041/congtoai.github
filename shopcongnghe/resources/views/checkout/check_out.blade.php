@extends('login_layout')
@section('content1')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active" style="color: #000;">Thông tin đặt hàng</li>
            </ol>
        </div>


        <div class="register-req" style="width: 100%; background-color: #c0c0c0;">
            <p>Hãy đăng ký hoặc đăng nhập để thanh toán</p>
        
        <!--/register-req-->

        <div class="shopper-informations" 
        style=" 
				
				top: 50%;
				left: 50%;
				width: 60em;
				height:35em;
				margin-top: 5em; 
				margin-left: 25em;">
            <div class="row">

                <div>
                    <div class="bill-to">
                        <p>Thông tin thanh toán</p>
                        <div class="form-one" style="width: 450px;">
                            <form action="{{URL::to('/save-check-out')}}" method="Post">
                                {{csrf_field()}}
                                <input type="text" name="sp_name" placeholder="Họ tên *">
                                <input type="text" name="sp_email" placeholder="Email*">
                                <input type="text" name="sp_phone" placeholder="Số điện thoại*">
                                <input type="text" name="sp_address" placeholder="Địa chỉ  *">
                                <textarea name="sp_note" placeholder="Ghi chú" rows="5"></textarea>
                                <input class="btn btn-primary btn-sm" type="submit" name="send_oder" value="Trang thanh toán" style="width:40%; float:right;">
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            </div>
        </div>

        <div class="review-payment" >
                <h2>Xem giỏ hàng</h2>
                <br>
            </div>
</section>
<!--/#cart_items-->
@endsection
