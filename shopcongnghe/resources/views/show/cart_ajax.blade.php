@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container col-sm-12 ">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active" style="color: #000;">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info col-sm-12" style="padding-right: 0px; padding-left: 0px;">
           
            <table class="table table-condensed ">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        print_r(Session::get('cart'));
                   ?>

                    <tr>
                        <td class="cart_product">
                            <a href=""><img src=""
                                    style="width:60px;height:60px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4 style="margin: 0px;"><a href=""></a></h4>

                        </td>
                        <td class="cart_price">
                            <p style="margin: 0px;"></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="" method="post">
                                   
                                    <input class="cart_quantity_input" type="text" name="cart_quantity"
                                        value="" size="2">
                                    <input class="form-control" type="hidden" name="rowId_cart"
                                        value="">
                                    <input class="btn btn-default btn-sm" type="submit" name="update_cart" value="Sửa">
                                </form>

                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" style="margin: 0px;">
                               
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete " style="color:black;"
                                href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                 
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action ">
    <div class="container col-sm-12">
        <div class="heading">
            <h3 style="margin-left: 420px;">Hóa đơn:</h3>

        </div>
        <div class="row">
            <div class="col-sm-6"
                style="width: 50%;border: 1px solid white;height: 220px;margin-bottom: 1%;float:right;">
                <div class="total_area">
                    <ul style="padding-inline-start: 5px;">
                        <li>Tổng:<span></span></li>
                        <!-- <li>Thuế <span>{{Cart::tax().' '.'VNĐ'}}</span></li> -->
                        <li>Phí vận chuyển: <span>Free</span></li>
                        <li>Thành tiền: <span></span></li>
                    </ul>

                    <a class="btn btn-default check_out" style="float:right;" href="">Thanh toán</a>

                    <a class="btn btn-default check_out" style="float:right;" href="">Thanh toán</a>

                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection
