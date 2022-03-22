@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu sản phẩm
    </div>
          
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>     
        <?php
       $message = Session::get('message');
        if($message){
        echo '<span class = "text-alert">',$message,'</span>';
        Session::put('message',null);
        }
    ?>                        
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm!</button>
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
            <th>Tên thương hiệu</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_brand_product as $key => $br_prod)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$br_prod->br_name}}</td>
            <td>{{$br_prod->br_desc}}</td>
            <td><span class="text-ellipsis">
                <?php 
                    if($br_prod->br_status==0){
                ?>
                        <a href="{{URL::to('/unactive-brand-product/'.$br_prod->br_id)}}"><span class="fa-thumb-styling fa fa-up">Ẩn</span></a>
                <?php
                    }else{
                ?>
                        <a href="{{URL::to('/active-brand-product/'.$br_prod->br_id)}}"><span class="fa-thumb-styling fa fa-down">Hiện</span></a>
                <?php    
                    }
                ?>
            </span></td>
           
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$br_prod->br_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            </td>
            <td>
              <a onclick="return confirm('Bạn có muốn xóa?')" href="{{URL::to('/delete-brand-product/'.$br_prod->br_id)}}" class="active styling-delete" ui-toggle-class="">
                   <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">20-30 of 50 </small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection