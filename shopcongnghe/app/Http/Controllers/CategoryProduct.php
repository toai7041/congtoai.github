<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ad_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product() {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $mng_cgr_prod = view('admin.all_category_product')
        ->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$mng_cgr_prod);
    }

    public function save_category_product(Request $request) {
        $this->AuthLogin();
        $data = array();

        $data['cgr_name'] = $request->category_product_name;
        $data['cgr_desc'] = $request->category_product_desc;
        $data['cgr_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('/add-category-product');
    }

    public function active_category_product($cgr_prod_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('cgr_id',$cgr_prod_id)
        ->update(['cgr_status'=>0]);
        Session::put('message','Trạng thái ẩn kích hoạt');
        return Redirect::to('all-category-product');
    }

    public function unactive_category_product($cgr_prod_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('cgr_id',$cgr_prod_id)
        ->update(['cgr_status'=>1]);
        Session::put('message','Trạng thái hiển thị kích hoạt');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($cgr_prod_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')
        ->where('cgr_id',$cgr_prod_id)->get();
        $mng_cgr_prod = view('admin.edit_category_product')
        ->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$mng_cgr_prod);
    }

    public function update_category_product(Request $request,$cgr_prod_id){
        $this->AuthLogin();
        $data= array();
        $data['cgr_name'] = $request->category_product_name;
        $data['cgr_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('cgr_id',$cgr_prod_id)->update($data);
        Session::put('message','Đã cập nhật danh mục');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($cgr_prod_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('cgr_id',$cgr_prod_id)->delete();
        Session::put('message','Đã xóa danh mục');
        return Redirect::to('all-category-product');
    }

    ////////////////////////////////////////////////////////////////

    public function show_danhmuc($cgr_prod_id){

        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        $cgr_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.cgr_id','=','tbl_product.cgr_id')
        ->where('tbl_product.cgr_id',$cgr_prod_id)->get();

        $category_name = DB::table('tbl_category_product')
        ->where('tbl_category_product.cgr_id',$cgr_prod_id)->limit(1)->get();

        return view('show.show_cgr')->with('category',$cgr_product)
        ->with('brand',$br_product)->with('cgr_by_id',$cgr_by_id)
        ->with('category_name',$category_name);
    }


    


}

