<?php

use Illuminate\Support\Facades\Route;

/** Auth guarded routes */
Route::middleware('auth:api')->group(function () {
    /** Admin resources */
    Route::namespace('Account')->prefix('account')->group(function () {
        Route::get('domains/list', 'DomainController@list');
        Route::apiResource('domains', 'DomainController');
        Route::apiResource('links', 'LinkController');
        Route::get('links/{link}/analytics', 'DashboardController');
        Route::get('dashboard', 'DashboardController');

        Route::get('profile', 'ProfileController@show');
        Route::put('profile', 'ProfileController@update');
        Route::post('profile/image', 'ProfileController@uploadImage');
    });

    /** User resources */
    Route::namespace('Admin')->prefix('admin')->group(function () {
        Route::apiResource('domains', 'DomainController');
        Route::apiResource('links', 'LinkController');
        Route::get('links/{link}/analytics', 'DashboardController');
        Route::get('dashboard', 'DashboardController');

        /** Roles and permissions */
        Route::namespace('Permission')->group(function () {
            Route::apiResource('permissions', 'PermissionController');
            Route::apiResource('roles', 'RoleController');
        });

        Route::apiResource('users', 'UserController');
    });
});

/** Main routes */
Route::namespace('Frontend')->group(function () {
    Route::get('domains', 'DomainController');
    Route::post('links/{hash}', 'LinkController@check');
    Route::post('links', 'LinkController@store');
});

/** Authentication */
Route::middleware('api')->prefix('auth')->namespace('Auth')->group(function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::get('me', 'AuthController@me')->name('me');
});
