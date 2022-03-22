@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm phí vận chuyển
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
                    <form>
                        
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleInputPassword1"> Chọn Tỉnh/Thành phố </label>
                            <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                <option value="">--Chọn Tỉnh/Thành phố--</option>
                                @foreach($city as $key => $tp)
                                <option value="{{$tp->matp}}">{{$tp->name_tp}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1"> Chọn Quận/Huyện </label>
                            <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                <option value="">--Chọn Quận/Huyện--</option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1"> Chọn Xã, phường/Thị trấn </label>
                            <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                <option value="">--Chọn Xã, phường/Thị trấn--</option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control">
                                </div>

                        <button type="button" name="add_fee" class="btn btn-info add_fee">Thêm phí vận chuyển</button>
                    </form>
                </div>
                
                <div id = "load_delivery">
                
                </div>

            </div>
        </section>

    </div>

    @endsection
