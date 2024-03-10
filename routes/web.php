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
Route::get('/ha', function () {
    return view('test');    
});
// Route::get('/','HomeController@index');
// Route::get('/trang-chu','Homecontroller@index');
Route::get('/', 'HomeController@index');
Route::get('/ha', 'HomeController@test');
Route::post('/tim-kiem', 'HomeController@tim_kiem');

//danh mục san phẩm home
Route::get('/danhmucsanpham/{category_id}', 'Categoryproduct@show_category_home');
Route::get('/chitietsanpham/{category_id}', 'ProductController@details_product');

Route::get('/trang-chu', 'HomeController@index');
Route::get('/admin', 'AdminController@index1');
Route::get('/dashboard', 'AdminController@showdashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

//category product
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');


Route::post('/save-category-prduct', 'CategoryProduct@save_category_product');
Route::get('/active/{category_product_id}', 'CategoryProduct@active');
Route::get('/unactive/{category_product_id}', 'CategoryProduct@unactive');

//product
Route::get('/add-product', 'ProductController@add_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');


Route::post('/save-product', 'ProductController@save_product');
Route::get('/activepr/{product_id}', 'ProductController@active');
Route::get('/unactivepr/{product_id}', 'ProductController@unactive');
Route::get('/test', 'ProductController@test');
// cart
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart-quantity/{rowId}', 'CartController@update_cart_quantity');
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::get('/gio-hang', 'CartController@gio_hang');
//coupon
Route::post('/check-coupon', 'CartController@check_coupon');

//checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::get('/checkout/{customer_id}', 'CheckoutController@checkout');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
Route::post('/check-login', 'CheckoutController@check_login');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/order-place', 'CheckoutController@order_place');

//đơn hàng
Route::get('/manage-order', 'CheckoutController@manage_order');
Route::get('/view-order/{orderId}', 'CheckoutController@view_order');
Route::get('/delete-order/{orderId}', 'CheckoutController@delete_order');
