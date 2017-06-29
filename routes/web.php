<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/regsuccess', function () {
    return view('reg');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('dash', 'DashboardController@index');

    Route::get('reset', 'ManagerController@getReset')->name('admin.reset');
    Route::post('reset', 'ManagerController@postReset');

    Route::resource('area', 'AreaController',['except' => 'show']);
    Route::resource('company', 'CompanyController',['except' => 'show']);
    Route::resource('productType', 'ProductTypeController',['except' => 'show']);
    Route::resource('productFunction', 'productFunctionController',['except' => 'show']);
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');