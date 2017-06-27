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
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('dash', 'DashboardController@index');

    Route::get('reset', 'ManagerController@getReset')->name('admin.reset');
    Route::post('reset', 'ManagerController@postReset');
});