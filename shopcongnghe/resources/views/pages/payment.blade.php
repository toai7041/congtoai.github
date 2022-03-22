@extends('login_layout')
@section('content1')

<section id="cart_items">
    <div class="container" col-sm-12>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active" style="color: #000;">Thanh toán hàng</li>
            </ol>
        </div>


        <!--/register-req-->


        <div class="review-payment" col-sm-12>
            <h2>Xem giỏ hàng</h2>
            <br>
        </div>

        <div class="table-responsive cart_info col-sm-12" style="padding-right: 0px; padding-left: 0px;">
            <?php
            $content= Cart::content();
            // echo '<pre>';
            // print_r($content);
            // echo '</pre>';   

            ?>
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

                    @foreach($content as $key => $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('/public/uploads/product/'.$v_content->options->image)}}"
                                    style="width:60px;height:60px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4 style="margin: 0px;"><a href="">{{$v_content->name}}</a></h4>

                        </td>
                        <td class="cart_price">
                            <p style="margin: 0px;">{{number_format($v_content->price)." VNĐ"}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart-qty')}}" method="post">
                                    {{csrf_field()}}
                                    <input class="cart_quantity_input" type="text" name="cart_quantity"
                                        value="{{$v_content->qty}}" size="2">
                                    <input class="form-control" type="hidden" name="rowId_cart"
                                        value="{{$v_content->rowId}}">
                                    <input class="btn btn-default btn-sm" type="submit" name="update_cart" value="Sửa">
                                </form>

                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" style="margin: 0px;">
                                <?php
                               $subtotal = $v_content->price * $v_content->qty;
                               echo number_format($subtotal),' ','VNĐ';
                               ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete " style="color:black;"
                                href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4> Chọn hình thức thanh toán </h4>
        <br />
        <br />
        <br />
        <form method="post" action="{{URL::to('/order-place')}}">
            {{csrf_field()}}
            <div class="payment-options" >
                <span>
                    <label><input name="options" value="1" type="checkbox" > Trả thông qua ATM</label>
                </span>
                <span>
                    <label><input name="options" value="2" type="checkbox"> Trả khi nhận hàng</label>
                </span>
                
                <input class="btn btn-primary btn-lg" type="submit" name="send_oder_place" value="Thanh toán" style="float:right;">
            </div>
           
        </form>
    </div>
</section>
<!--/#cart_items-->
@endsection
