<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ad_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this->AuthLogin();
        $cgr_product = DB::table('tbl_category_product')->orderby('cgr_id','desc')->get();
        $br_product = DB::table('tbl_brand')->orderby('br_id','desc')->get();
        
        return view('admin.add_product')->with('cgr_product',$cgr_product)->with('br_product',$br_product);
    }

    public function all_product() {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.cgr_id','=','tbl_product.cgr_id')
        ->join('tbl_brand','tbl_brand.br_id','=','tbl_product.br_id')
        ->orderby('tbl_product.pr_id','desc')->get();
        $mng_prod = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$mng_prod);
    }

    public function save_product(Request $request) {
        $this->AuthLogin();
        $data = array();

        $data['pr_name'] = $request->product_name;
        $data['pr_desc'] = $request->product_desc;
        $data['pr_content'] = $request->product_content;
        $data['pr_price'] = $request->product_price;
        $data['pr_color'] = $request->product_color;
        $data['br_id'] = $request->brand_product;
        $data['cgr_id'] = $request->category_product;
        $data['pr_status'] = $request->product_status;

        $get_image = $request->file('pr_image');
        

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['pr_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm thành công');
            return Redirect::to('add-product');
            
        }
        $data['pr_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('add-product');
    }

    public function active_product($pr_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('pr_id',$pr_id)->update(['pr_status'=>0]);
        Session::put('message','Trạng thái ẩn kích hoạt');
        return Redirect::to('all-product');
    }

    public function unactive_product($pr_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('pr_id',$pr_id)->update(['pr_status'=>1]);
        Session::put('message','Trạng thái hiển thị kích hoạt');
        return Redirect::to('all-product');
    }

    public function edit_product($pr_id){
        $this->AuthLogin();
        
        $cgr_product = DB::table('tbl_category_product')->orderby('cgr_id','desc')->get();
        $br_product = DB::table('tbl_brand')->orderby('br_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('pr_id',$pr_id)->get();
        $mng_prod = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cgr_product',$cgr_product)
        ->with('br_product',$br_product);
        return view('admin_layout')->with('admin.edit_product',$mng_prod);
    }

    public function update_product(Request $request,$pr_id){
        $this->AuthLogin();
        $data= array();

        $data['pr_name'] = $request->product_name;
        $data['pr_desc'] = $request->product_desc;
        $data['pr_content'] = $request->product_content;
        $data['pr_price'] = $request->product_price;
        $data['pr_color'] = $request->product_color;
        $data['br_id'] = $request->brand_product;
        $data['cgr_id'] = $request->category_product;
        $data['pr_status'] = $request->product_status;
        $get_image = $request->file('pr_image');
        

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['pr_image'] = $new_image;
            DB::table('tbl_product')->where('pr_id',$pr_id)->update($data);
            Session::put('message','Cập nhật thành công');
            return Redirect::to('all-product');
            
        }
        DB::table('tbl_product')->where('pr_id',$pr_id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('all-product');
    }


    public function delete_product($pr_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('pr_id',$pr_id)->delete();
        Session::put('message','Đã xóa sản phẩm');
        return Redirect::to('all-product');
    }
    ////////////////////////////////////////////////////////////////

    public function show_chitiet($pr_id){
        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        $detail_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.cgr_id','=','tbl_product.cgr_id')
        ->join('tbl_brand','tbl_brand.br_id','=','tbl_product.br_id')
        ->where('tbl_product.pr_id',$pr_id)->get();
        
        foreach($detail_product as $key => $detail){
            $category_id = $detail->cgr_id;
        }

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.cgr_id','=','tbl_product.cgr_id')
        ->join('tbl_brand','tbl_brand.br_id','=','tbl_product.br_id')
        ->where('tbl_product.cgr_id',$category_id)
        ->whereNotIn('tbl_product.pr_id',[$pr_id])->orderby('pr_id','desc')->limit(6)->get();

        $test = array();
        for ($i = 0; $i < count($related_product) / 3; $i++) {
            $element = array();
            for ($j = $i*3; $j < $i*3 + 3 && $j < count($related_product); $j++) {
                array_push($element, $related_product[$j]);
            }
            array_push($test, $element);
        }


        return view('show.show_detail')
        ->with('category',$cgr_product)
        ->with('brand',$br_product)
        ->with('detail_product',$detail_product)
        ->with('related_product',$related_product)
         ->with('test', $test);
    }
}
