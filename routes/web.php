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

Route::get('/', 'Admin\DashboardController@index')->name('dash');
Route::get('/regsuccess','HomeController@regsuccess')->name('regsuccess');

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    Route::get('dash', 'DashboardController@index')->name('admin.dash');
    Route::post('dash/uploadImgFile', ['uses' => 'DashboardController@uploadImgFile', 'as' => 'dash.upload']);

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

    Route::get('product/{id}/address',['uses' => 'ProductController@getProductAddress', 'as' => 'product.getProductAddress']);
    Route::post('product/{id}/address',['uses' => 'ProductController@postProductAddress', 'as' => 'product.postProductAddress']);
    Route::post('product/{id}/deleteAddress',['uses' => 'ProductController@destoryProductAddress', 'as' => 'product.destoryProductAddress']);
    Route::any('product/search',['uses' => 'ProductController@search','as' => 'product.search']);
    Route::resource('product', 'ProductController', ['except' => 'show']);

    Route::get('autogendetail', 'ProductDetailController@getAutoGenDetail');
    Route::post('autogendetail', ['uses' => 'ProductDetailController@postAutoGenDetail','as' => 'detail.postAutoGenDetail']);

    Route::any('product/{id}/detail/search',['uses' => 'ProductDetailController@search','as' => 'detail.search']);
    Route::get('product/{id}/details/batcreate',['uses'=>'ProductDetailController@batCreate','as'=>'detail.batCreate']);
    Route::post('product/{id}/details',['uses'=>'ProductDetailController@batStore','as'=>'detail.batStore']);
    Route::get('product/{id}/comments',['uses'=>'CommentController@comments','as'=>'product.comments']);
    Route::resource('product/{id}/detail', 'ProductDetailController', ['except' => 'show']);

    Route::get('buyrecord', ['uses' => 'BuyrecordController@index','as' => 'buyrecord.index']);
    Route::get('buyrecord/{id}/edit', ['uses' => 'BuyrecordController@edit','as' => 'buyrecord.edit']);
    Route::any('buyrecord/search', ['uses' => 'BuyrecordController@search','as' => 'buyrecord.search']);
    Route::post('buyrecord/consumpt', ['uses' => 'BuyrecordController@consumpt','as' => 'buyrecord.consumpt']);
    Route::post('buyrecord/overdue', ['uses' => 'BuyrecordController@overdue','as' => 'buyrecord.overdue']);
    Route::post('buyrecord/cancel', ['uses' => 'BuyrecordController@cancel','as' => 'buyrecord.cancel']);

    Route::get('badrecord', ['uses' => 'BadrecordController@index','as' => 'badrecord.index']);
    Route::get('badrecord/{id}/edit', ['uses' => 'BadrecordController@edit','as' => 'badrecord.edit']);
    Route::any('badrecord/search', ['uses' => 'BadrecordController@search','as' => 'badrecord.search']);


    Route::resource('customer', 'CustomerController', ['except' => 'show']);

    Route::get('log/manager', ['uses' => 'LogController@manager','as' => 'log.manager.index']);
    Route::get('log/customer', ['uses' => 'LogController@customer','as' => 'log.customer.index']);

    Route::get('upload', 'UploadController@index');
    Route::post('upload/file', 'UploadController@uploadFile');
    Route::delete('upload/file', 'UploadController@deleteFile');
    Route::post('upload/folder', 'UploadController@createFolder');
    Route::delete('upload/folder', 'UploadController@deleteFolder');

    Route::post('loadManager', 'LoadExcelController@loadManager');
    Route::get('explorer/{type}', 'LoadExcelController@fileExplorer');

    Route::get('comment', ['uses' => 'CommentController@index', 'as' => 'comment.index']);
    Route::post('comment/destroy','CommentController@destroy');
    Route::post('comment/verify', 'CommentController@verify');
    Route::any('comment/search',['uses' => 'CommentController@search', 'as' => 'comment.search']);
});
// Login Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');