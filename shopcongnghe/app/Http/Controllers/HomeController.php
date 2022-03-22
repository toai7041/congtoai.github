<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){
        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')->orderby('br_id','desc')->get();

        $all_product = DB::table('tbl_product')
        ->where('pr_status','1')->orderby('pr_id','desc')->limit(20)->get();


        return view('pages.home')->with('category',$cgr_product)
        ->with('brand',$br_product)->with('all_product',$all_product);
    }

    public function search(Request $request){

        $keywords = $request->keywords_submit;

        $cgr_product = DB::table('tbl_category_product')
        ->where('cgr_status','1')->orderby('cgr_id','desc')->get();

        $br_product = DB::table('tbl_brand')
        ->where('br_status','1')->orderby('br_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->where('pr_status','1')->orderby('pr_id','desc')->limit(3)->get();

        $search_product = DB::table('tbl_product')
        ->where('pr_name','like',"%".$keywords."%")->get();

        return view('pages.search')
        ->with('category',$cgr_product)
        ->with('brand',$br_product)
        ->with('search_product',$search_product);
    }
}
