<?php

// HTML routes
Route::get('/', 'HTMLController@home');
Route::get('/dash', 'HTMLController@dash');
Route::get('/menu', 'HTMLController@menu');

// API routes
Route::group(['prefix' => 'api-V1'], function () {

    // Auth routes
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/reset-password', 'AuthController@resetPassword');
    Route::post('/verify-new', 'AuthController@verifyNew');
    Route::post('/verify-reset', 'AuthController@verifyReset');

    // Admin only routes
    Route::group(['middleware' => ['token', 'checkRole:admin']], function () {

        Route::resource(
            'site-config',
            'SiteConfigController',
            ['only' => ['show', 'update']]
        );

        Route::resource(
            'role',
            'RolesController',
            ['only' => ['index']]
        );

        Route::resource(
            'user',
            'UsersController',
            ['only' => ['index']]
        );

    });

    // Owner only routes
    Route::group(['middleware' => ['token', 'checkRole:owner']], function () {

        Route::resource(
            'menu-section',
            'MenuSectionsController',
            ['only' => ['index', 'store', 'show', 'update', 'destroy']]
        );

        Route::resource(
            'menu-item',
            'MenuItemsController',
            ['only' => ['store', 'show', 'update', 'destroy']]
        );

        Route::resource(
            'about',
            'AboutController',
            ['only' => ['show', 'update']]
        );

        Route::resource(
            'info',
            'InfoController',
            ['only' => ['show', 'update']]
        );

        Route::resource(
            'hour',
            'HoursController',
            ['only' => ['index', 'show', 'update']]
        );

        Route::resource(
            'photo',
            'PhotosController',
            ['only' => ['index', 'show', 'destroy']]
        );

    });

});
