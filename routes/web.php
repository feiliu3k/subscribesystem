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
    Route::resource('productFunction', 'ProductFunctionController',['except' => 'show']);

    Route::get('role/editPermission/{id}',['uses' => 'RoleController@editPermission', 'as' => 'role.editPermission']);
    Route::post('role/updatePermission/{id}',['uses' => 'RoleController@updatePermission', 'as' => 'role.updatePermission']);
    Route::get('manager/editRole/{id}',['uses' => 'ManagerController@editRole', 'as' => 'manager.editRole']);
    Route::post('manager/updateRole/{id}',['uses' => 'ManagerController@updateRole', 'as' => 'manager.updateRole']);
    Route::post('manager/changePassword',['uses' => 'ManagerController@changePassword', 'as' => 'manager.changePassword']);
    Route::resource('permission', 'PermissionController',['except' => 'show']);
    Route::resource('role', 'RoleController',['except' => 'show']);
    Route::resource('manager', 'ManagerController',['except' => 'show']);

    Route::resource('product', 'ProductController');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');