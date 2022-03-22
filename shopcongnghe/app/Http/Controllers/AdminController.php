<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ad_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $ad_email = $request-> ad_email;
        $ad_pw = md5($request-> ad_pw);

        $result = DB::table('tbl_admin')->where('ad_email', $ad_email)->where('ad_pw', $ad_pw)-> first();
        if($result){
            Session::put('ad_name', $result->ad_name);
            Session::put('ad_id', $result->ad_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai. Mời nhập lại!!!');
            return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('ad_name',null);
        Session::put('ad_id',null);
        return Redirect::to('/admin');
    }

    public function manage_order(){

        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.ctm_id','=','tbl_customer.ctm_id')
        ->select('tbl_order.*','tbl_customer.ctm_name')
        ->orderby('tbl_order.od_id','desc')->get();
        $mng_order = view('admin.manage_order')->with('all_order',$all_order);

        return view('admin_layout')->with('admin.manage_order',$mng_order);

    }

    public function view_order($orderId){

        $this->AuthLogin();

        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.ctm_id','=','tbl_customer.ctm_id')
        ->join('tbl_shipping','tbl_order.sp_id','tbl_shipping.sp_id')
        ->join('tbl_order_detail','tbl_order.od_id','tbl_order_detail.od_id')

        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_detail.*')->first();
        $mng_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);

        return view('admin_layout')->with('admin.view_order',$mng_order_by_id);
    }

    
    public function delete_order($od_id){
        $this->AuthLogin();
        DB::table('tbl_order')->where('od_id',$od_id)->delete();
        Session::put('message','Đã xóa sản phẩm');
        return Redirect::to('manage-order');
    }
}
