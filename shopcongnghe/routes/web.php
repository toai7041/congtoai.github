<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');


//backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');

//order
Route::get('/manage-order','AdminController@manage_order');
Route::get('/view-order/{orderId}','AdminController@view_order');
Route::get('/delete-order/{orderId}','AdminController@delete_order');



//show
Route::get('/danhmucsanpham/{cgr_prod_id}','CategoryProduct@show_danhmuc');
Route::get('/thuonghieusanpham/{br_prod_id}','BrandProduct@show_thuonghieu');
Route::get('/chitietsanpham/{pr_id}','ProductController@show_chitiet');


//cart
Route::post('/save-cart','CartController@save_cart');
Route::post('/add-cart','CartController@add_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/cart-2','CartController@cart_2');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
Route::post('/update-cart-qty','CartController@update_cart_qty');

//checkout
Route::get('/login-check-out','CheckoutController@login_check_out');
Route::get('/logout-check-out','CheckoutController@logout_check_out');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');

Route::post('/order-place','CheckoutController@order_place');
Route::get('/check-out','CheckoutController@check_out');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-check-out','CheckoutController@save_check_out');



//category product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{cgr_prod_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{cgr_prod_id}','CategoryProduct@delete_category_product');

Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/active-category-product/{cgr_prod_id}','CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{cgr_prod_id}','CategoryProduct@unactive_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{cgr_prod_id}','CategoryProduct@update_category_product');



//brand product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{br_prod_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{br_prod_id}','BrandProduct@delete_brand_product');

Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/active-brand-product/{br_prod_id}','BrandProduct@active_brand_product');
Route::get('/unactive-brand-product/{br_prod_id}','BrandProduct@unactive_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{br_prod_id}','BrandProduct@update_brand_product');




//product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{pr_id}','ProductController@edit_product');
Route::get('/delete-product/{pr_id}','ProductController@delete_product');

Route::get('/all-product','ProductController@all_product');

Route::get('/active-product/{pr_id}','ProductController@active_product');
Route::get('/unactive-product/{pr_id}','ProductController@unactive_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{pr_id}','ProductController@update_product');

//delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');

