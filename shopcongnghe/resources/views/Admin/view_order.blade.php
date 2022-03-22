@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
          
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
       
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
        
          <span class="input-group-btn">
         
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;"></th>
            <th>Tên người đặt hàng</th>
            <th>Số điện thoại</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td></td>
            <td>{{$order_by_id->ctm_name}}</td>
            <td>{{$order_by_id->ctm_phone}}</td>
            <td></td>
          
      
          </tr>
      
        </tbody>
      </table>
    </div>
    
  </div>
</div>

</br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
          
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
              
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          
          <span class="input-group-btn">
           
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
             
            </th>
            <th>Tên người nhận hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td></td>
            <td>{{$order_by_id->sp_name}}</td>
            <td>{{$order_by_id->sp_phone}}</td>
            <td>{{$order_by_id->sp_address}}</td>

          </tr>
      
        </tbody>
      </table>
    </div>
    
  </div>
</div>


</br>

    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>
          
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
                  
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          
          <span class="input-group-btn">
            
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
             
            </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td>{{$order_by_id->pr_name}}</td>
            <td>{{$order_by_id->pr_sales_quatity}}</td>
            <td>{{$order_by_id->pr_price}}</td>
            <td>{{$order_by_id->od_total}}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection