<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('before'=>'wechat.base'), function(){

        Route::get('/', 'ListController@showIndex');

        Route::get('/list', 'ListController@showList');

        Route::get('/profile', 'UserController@showProfile');

        Route::post('/profile', 'UserController@editProfile');

        Route::get('/phone', 'UserController@showPhone');

        Route::get('/address', 'UserController@showAddAddress');

        Route::post('/address', 'UserController@addAddress');

        Route::delete('/address/{id}', 'UserController@delAddress');

        Route::get('/orders', 'UserController@showOrders');

        Route::get('/order/{id}', 'OrderController@showOrder');

        Route::get('/product/{id}', 'ProductController@showProduct');

        Route::get('/cart', 'CartController@showCart');

        Route::post('/cart', 'CartController@checkCart');

        Route::post('/editcart', 'CartController@editCart');

        Route::get('/checkorder', 'OrderController@showCheckOrder');

        Route::post('/checkorder', 'OrderController@checkOrder');

        Route::get('/orderaddr', 'OrderController@showAddressee');

        Route::post('/orderaddr', 'OrderController@editAddressee');

});



Route::get('/admin/login', 'AdminController@login');

Route::post('/admin/login', 'AdminController@checkLogin');


Route::group(array('before'=>'admin'), function(){

        Route::get('/admin', 'AdminController@settings');

        Route::get('/admin/setting', 'AdminController@setting');

        Route::get('/admin/product', 'AdminController@product');

        Route::get('/admin/user', 'AdminController@user');

        Route::get('/admin/order', 'AdminController@order');

});
