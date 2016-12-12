<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::get('/', 'WellcomeController@index');

Route::get('test', function () {
    $user = auth()->authenticate();
});
//Route::get('owners', array('middleware' => 'auth', 'uses' => 'PownersController@ownerlist'));
//Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::auth();
    Route::group(['prefix' => 'cate'], function () {
    	Route::get('list', ['as' => 'admin.cate.list', 'uses' => 'CateController@getList']);
        Route::get('add', ['as' => 'admin.cate.getAdd', 'uses' => 'CateController@getAdd']);
        Route::post('add', ['as' => 'admin.cate.postAdd', 'uses' => 'CateController@postAdd']);
        Route::get('delete/{id}', ['as' => 'admin.cate.getDelete', 'uses' => 'CateController@getDelete']);
         Route::get('edit/{id}', ['as' => 'admin.cate.getEdit', 'uses' => 'CateController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.cate.postEdit', 'uses' => 'CateController@postEdit']);
        
    });

    Route::group(['prefix' => 'user'], function () {
        //user
        Route::get('list', ['as' => 'admin.user.list', 'uses' => 'UserController@getList']);
        Route::get('add', ['as' => 'admin.user.getAdd', 'uses' => 'UserController@getAdd']);
        Route::post('add', ['as' => 'admin.user.postAdd', 'uses' => 'UserController@postAdd']);
        Route::get('delete/{id}', ['as' => 'admin.user.getDelete', 'uses' => 'UserController@getDelete']);
         Route::get('edit/{id}', ['as' => 'admin.user.getEdit', 'uses' => 'UserController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.user.postEdit', 'uses' => 'UserController@postEdit']);
        //Route::get('login', ['as' => 'admin.user.login', 'uses' => 'Auth\LoginController@showLoginForm']);
        //Route::post('login', ['as' => 'admin.user.postLogin', 'uses' => 'Auth\LoginController@login']);
    });

    Route::group(['prefix' => 'product'], function () {
        //user
        Route::get('list', ['as' => 'admin.product.list', 'uses' => 'ProductController@getList']);
        Route::get('add', ['as' => 'admin.product.getAdd', 'uses' => 'ProductController@getAdd']);
        Route::post('add', ['as' => 'admin.product.postAdd', 'uses' => 'ProductController@postAdd']);
        Route::get('delete/{id}', ['as' => 'admin.product.getDelete', 'uses' => 'ProductController@getDelete']);
        Route::get('edit/{id}', ['as' => 'admin.product.getEdit', 'uses' => 'ProductController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.product.postEdit', 'uses' => 'ProductController@postEdit']);
        Route::get('delImg/{id}', ['as' => 'admin.product.getDelImg', 'uses' => 'ProductController@getDelImg']);
        Route::post('updateImage', ['as' => 'admin.product.updateImage', 'uses' => 'ProductController@updateImage']);
    });
});

Auth::routes();
/*public function auth()
    {
        https://github.com/laravel/framework/blob/5.3/src/Illuminate/Routing/Router.php
        // Authentication Routes...
        $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('login', 'Auth\LoginController@login');
        $this->post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        $this->get('register', 'Auth\RegisterController@showRegistrationForm');
        $this->post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    }*/
Route::get('/home', 'HomeController@index');

Route::get('/relation', function () {
    $data = App\Product::find(2)->images()->get()->toArray();
    print_r($data);
});

Route::get('/test',function(){
    return view('user.pages.home');
});

Route::get('loai-san-pham/{id}/{tenloai}', ['as' => 'loaisanpham', 'uses' => 'WellcomeController@loaisanpham']);
