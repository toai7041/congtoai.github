@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container col-sm-12 ">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active" style="color: #fab005;">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info col-sm-12" style="padding: 0 5px;">
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
                        <li>Tổng:<span>{{Cart::total().' '.'VNĐ'}}</span></li>
                        <!-- <li>Thuế <span>{{Cart::tax().' '.'VNĐ'}}</span></li> -->
                        <li>Phí vận chuyển: <span>Free</span></li>
                        <li>Thành tiền: <span>{{Cart::total().' '.'VNĐ'}}</span></li>
                    </ul>
                    <!-- <a class="btn btn-default update" href="">Cập nhật</a> -->
                    <?php
									$customer_id = Session::get('ctm_id'); 
									if ($customer_id!=null){

								?>
                    <a class="btn btn-default check_out" style="float:right;" href="{{URL::to('check-out')}}">Thanh
                        toán</a>
                    <?php
									}else{
								?>
                    <a class="btn btn-default check_out" style="float:right;"
                        href="{{URL::to('login-check-out')}}">Thanh toán</a>
                    <?php
									}
								?>

                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection
