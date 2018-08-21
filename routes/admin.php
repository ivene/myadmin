<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|Good dragon, always so handsome
|
*/
//不用登陆验证的
Route::group(['namespace' => 'Admin','prefix' => 'admin'], function () {
    Route::get('login', 'AdminController@loginView');  //后台登陆页面
    Route::post('loginc', 'AdminController@login'); //后台登陆逻辑
    Route::get('logout', 'AdminController@logout')->name('admin.logout');  //退出
});
//需要登录验证的
Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
    //用户
    Route::group(['prefix' => 'user'], function () {
        Route::get('view', 'UserController@view');
        Route::get('list', 'UserController@list');
        Route::post('delete', 'UserController@delete');
        Route::post('listdata', 'UserController@getListData');
        Route::post('save', 'UserController@save');
    });
    //权限
    Route::group(['prefix' => 'power'], function () {
        Route::get('view','PowerController@view');
        Route::get('two-view','PowerController@addTwoMenus');
        Route::get('list','PowerController@list');
        Route::post('listdata','PowerController@getListData');
        Route::post('delete','PowerController@delete');
        Route::post('save','PowerController@save');
    });
    //部门
    Route::group(['prefix' => 'dept'], function () {
        Route::get('view','DepartmentController@view');
        Route::get('list','DepartmentController@list');
        Route::post('listdata','DepartmentController@getListData');
        Route::post('delete','DepartmentController@delete');
        Route::post('save','DepartmentController@save');
    });
    //职位 角色
    Route::group(['prefix' => 'posi'], function () {
        Route::get('view','PositionController@view');
        Route::get('list','PositionController@list');
        Route::post('delete','PositionController@delete');
        Route::post('listdata','PositionController@getListData');
        Route::post('save','PositionController@save');
    });
    //用户头像管理
    Route::group(['prefix'=>'userimg'],function (){
        Route::get('list','UserController@userImg_list');
        Route::get('edit','UserController@userImg_edit');
        Route::post('getSysMediaDatas','UserController@getSysMediaDatas');
        Route::post('save','UserController@userImg_save');
    });
});
Route::group(['middleware'=>'adminAuth','namespace' => 'Admin','prefix' => 'admin'], function (){
    //首页管理
    Route::any('admin','AdminController@index');
    Route::get('index','AdminController@index');//首页

});

