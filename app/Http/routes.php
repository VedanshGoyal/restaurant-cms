<?php

Route::get('/', 'HomeController@index');

// Auth Routes

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/reset-password', 'AuthController@resetPassword');
Route::get('/verify-new/?token', 'AuthController@verifyNew');
Route::get('/verify-reset/?token', 'AuthController@verifyReset');

// API Routes

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
    ['only' => ['index', 'show', 'store', 'destroy']]
);

Route::resource(
    'site-config',
    'SiteConfigController',
    ['only' => ['show', 'update']]
);
