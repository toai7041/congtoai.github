<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ad_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product() {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $mng_br_prod = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$mng_br_prod);
    }

    public function save_brand_product(Request $request) {
        $this->AuthLogin();
        $data = array();

        $data['br_name'] = $request->brand_product_name;
        $data['br_desc'] = $request->brand_product_desc;
        $data['br_status'] = $request->brand_product_status;

        DB::table('tbl_brand')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('/add-brand-product');
    }

    public function active_brand_product($br_prod_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('br_id',$br_prod_id)->update(['br_status'=>0]);
        Session::put('message','Trạng thái ẩn kích hoạt');
        return Redirect::to('all-brand-product');
    }

    public function unactive_brand_product($br_prod_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('br_id',$br_prod_id)->update(['br_status'=>1]);
        Session::put('message','Trạng thái hiển thị được kích hoạt');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($br_prod_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('br_id',$br_prod_id)->get();
        $mng_br_prod = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$mng_br_prod);
    }

    public function update_brand_product(Request $request,$br_prod_id){
        $this->AuthLogin();
        $data= array();
        $data['br_name'] = $request->brand_product_name;
        $data['br_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('br_id',$br_prod_id)->update($data);
        Session::put('message','Đã cập nhật thương hiệu');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($br_prod_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('br_id',$br_prod_id)->delete();
        Session::put('message','Đã xóa thương hiệu');
        return Redirect::to('all-brand-product');
    }

    ////////////////////////////////////////////////////////////////////////

    public function show_thuonghieu($br_prod_id){

        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        $br_by_id = DB::table('tbl_product')
        ->join('tbl_brand','tbl_brand.br_id','=','tbl_product.br_id')
        ->where('tbl_product.br_id',$br_prod_id)->get();

        $brand_name = DB::table('tbl_brand')
        ->where('tbl_brand.br_id',$br_prod_id)->limit(1)->get();

        return view('show.show_br')->with('category',$cgr_product)
        ->with('brand',$br_product)->with('br_by_id',$br_by_id)
        ->with('brand_name',$brand_name);
    }
}
