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

        Route::get('/address/{id}/delete', 'UserController@delAddress');

        Route::get('/order/{id}/share', 'OrderController@showShareOrder');

        Route::get('/product/{id}', 'ProductController@showProduct');

        Route::delete('/cart', 'CartController@deleteCart');

        Route::post('/editcart', 'CartController@editCart');

        Route::group(array('before'=>'subscribe'), function(){

                Route::get('/profile', 'UserController@showProfile');

                Route::post('/profile', 'UserController@editProfile');

                Route::get('/phone', 'UserController@showPhone');

                Route::get('/address', 'UserController@showAddAddress');

                Route::post('/address', 'UserController@addAddress');

                Route::get('/orders', 'UserController@showOrders');

                Route::get('/order/{id}', 'OrderController@showOrder');

                Route::post('/order/{id}/share', 'OrderController@editShareOrder');

                Route::get('/cart', 'CartController@showCart');

                Route::post('/cart', 'CartController@checkCart');

                Route::get('/checkorder', 'OrderController@showCheckOrder');

                Route::post('/checkorder', 'OrderController@checkOrder');

                Route::get('/orderaddr', 'OrderController@showAddressee');

                Route::post('/orderaddr', 'OrderController@editAddressee');

        });

        Route::get('/subscribe', function()
        {
                return View::make('subscribe');
        });

});



Route::get('/admin/login', 'AdminController@login');

Route::post('/admin/login', 'AdminController@checkLogin');


Route::group(array('before'=>'admin'), function(){

        Route::model('product', 'Product');

        Route::model('chef', 'Chef');

        Route::get('/admin', function()
        {
                return Redirect::to('/admin/order');
        });

        Route::get('/admin/setting', 'AdminController@setting');

        Route::get('/admin/product', 'AdminController@product');

        Route::post('/admin/product', 'AdminController@editProduct');

        Route::delete('/admin/product/{id}', 'AdminController@deleteProduct');

        Route::post('/admin/product/{product}/image', 'AdminController@addImage');

        Route::delete('/admin/product/{product}/image/{iid}', 'AdminController@deleteImage');

        Route::get('/admin/user', 'AdminController@user');

        Route::post('/admin/user/{id}', 'AdminController@editUser');

        Route::get('/admin/order/new', 'AdminController@orderNew');

        Route::get('/admin/order/{id}/status/{status}', 'AdminController@orderStatus');

        Route::get('/admin/order/today', 'AdminController@orderToday');

        Route::get('/admin/order/all', 'AdminController@orderAll');

        Route::get('/admin/order', function()
        {
                return Redirect::to('/admin/order/today');
        });

        Route::get('/admin/chef', 'AdminController@chef');

        Route::delete('/admin/chef/{id}', 'AdminController@deleteChef');

        Route::post('/admin/chef', 'AdminController@editChef');

        Route::post('/admin/chef/{chef}/image', 'AdminController@addImage');

        Route::delete('/admin/chef/{chef}/image/{iid}', 'AdminController@deleteImage');

});
