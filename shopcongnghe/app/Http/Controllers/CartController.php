<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        
        
        $prid = $request->productid_hidden;
        $quantity = $request->qty;

        $pr_info = DB::table('tbl_product')
        ->where('pr_id',$prid)->first();

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);

        $data['id'] = $pr_info->pr_id;
        $data['qty'] = $quantity;
        $data['name'] = $pr_info->pr_name;
        $data['weight'] = $pr_info->pr_price;
        $data['price'] = $pr_info->pr_price;
        $data['options']['image'] = $pr_info->pr_image;
        Cart::add($data);
        return Redirect::to('/show-cart');

    }

    public function cart_2(Request $request){
        
        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        return view('show.cart_ajax')
        ->with('category',$cgr_product)
        ->with('brand',$br_product);
    }

    public function show_cart(){
        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')
        ->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')
        ->orderby('br_id','desc')->get();

        return view('show.show_cart')
        ->with('category',$cgr_product)
        ->with('brand',$br_product);
    }

    public function delete_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');

    }

    public function update_cart_qty(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;

        Cart::update($rowId,$qty);

        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = Session::get('ctm_id');

        if($result){
            return Redirect::to('/payment');
        }else{
            return Redirect::to('/show-cart');
        }
        
    }

    public function add_cart(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['pr_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'pr_name' => $data['cart_product_name'],
                    'pr_id' => $data['cart_product_id'],
                    'pr_image' => $data['cart_product_image'],
                    'pr_qty' => $data['cart_product_qty'],
                    'pr_price' => $data['cart_product_price'],
                    );
                Session::put('cart',$cart);
            }
            }else{
                $cart[] = array(
                    'session_id' => $session_id,
                    'pr_name' => $data['cart_product_name'],
                    'pr_id' => $data['cart_product_id'],
                    'pr_image' => $data['cart_product_image'],
                    'pr_qty' => $data['cart_product_qty'],
                    'pr_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
       
        Session::save();

    }  

        
}
