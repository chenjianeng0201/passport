<?php

Route::group([
    'middleware' => 'passport-guard'
], function () {
    // 登录
    Route::post('login', 'AuthController@login');
    // 刷新 token
    Route::put('refresh', 'AuthController@refresh');
    Route::group([
        'middleware' => ['auth:api', 'scopes:customer']
    ], function () {
        // 退出
        Route::delete('logout', 'AuthController@logout');
        // 详情
        Route::get('customers/current', 'CustomersController@current');
    });
});
