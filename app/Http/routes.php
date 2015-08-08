<?php

Route::get('/', 'HomeController@index');

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
