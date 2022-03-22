<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{

    public function login_check_out(){

        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        return view('checkout.login_check_out')
        ->with('category',$cgr_product)
        ->with('brand',$br_product);
    }

    public function add_customer(Request $request){
        $data= array();

        $data['ctm_name']=$request->ctm_name;
        $data['ctm_phone']=$request->ctm_phone;
        $data['ctm_pw']=md5($request->ctm_pw);
        $data['ctm_email']=$request->ctm_email;

        $ctm_id= DB::table('tbl_customer')->insertGetId($data);

        Session::put('ctm_id',$ctm_id);
        Session::put('ctm_name',$request->ctm_name);

        return Redirect::to('/check-out');
    }

    public function check_out(){

        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        return view('checkout.check_out')
        ->with('category',$cgr_product)
        ->with('brand',$br_product);
    }
    public function save_check_out(Request $request){
        $data= array();

        $data['sp_name']=$request->sp_name;
        $data['sp_phone']=$request->sp_phone;
        $data['sp_note']=$request->sp_note;
        $data['sp_address']=$request->sp_address;
        $data['sp_email']=$request->sp_email;

        $sp_id= DB::table('tbl_shipping')->insertGetId($data);

        Session::put('sp_id',$sp_id);

        return Redirect::to('/payment');
    }

    public function logout_check_out(){
        Session::flush();
        return Redirect('/login-check-out');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = DB::table('tbl_customer')->where('ctm_email',$email)->where('ctm_pw',$password)->first();

        if($result){
            Session::put('ctm_id',$result->ctm_id);

            return Redirect::to('/check-out');
        }else{
            return Redirect::to('/login-check-out');
        }
    }

    public function payment(){
        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        return view('pages.payment')
        ->with('category',$cgr_product)
        ->with('brand',$br_product);
    }

    public function order_place(Request $request){

        //insert payment method
        $data= array();
        $data['pm_method']=$request->options;
        $data['pm_status']='Đang chờ xử lý';
        $pm_id= DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data= array();
        $order_data['ctm_id']=Session::get('ctm_id');
        $order_data['sp_id']=Session::get('sp_id');
        $order_data['pm_id']=$pm_id;
        $order_data['od_total']=Cart::total();
        $order_data['od_status']='Đang chờ xử lý';
        $od_id= DB::table('tbl_order')->insertGetId($order_data);

        //insert order detail
        $content= Cart::content();
        foreach($content as $v_content){
            $order_d_data= array();
            $order_d_data['od_id']=$od_id;
            $order_d_data['pr_id']=$v_content->id;
            $order_d_data['pr_name']=$v_content->name;
            $order_d_data['pr_price']=$v_content->price;
            $order_d_data['pr_sales_quatity']=$v_content->qty;
            DB::table('tbl_order_detail')->insertGetId($order_d_data);
        }

        if($data['pm_method']==1){
            echo 'Thanh toán qua thẻ ATM';
        }else{
            Cart::destroy();
            $cgr_product = DB::table('tbl_category_product')
            ->where('cgr_status','1')
            ->orderby('cgr_id','desc')->get();

            $br_product = DB::table('tbl_brand')
            ->where('br_status','1')
            ->orderby('br_id','desc')->get();


            return view('pages.handcash');
        }

        //return Redirect::to('/payment');
    }

   
}
