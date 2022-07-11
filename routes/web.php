<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Frontend')
    ->prefix('links')
    ->group(function () {
        Route::get('{hash}', 'LinkController@show')
            ->name('links.show');
    });

Route::get('{path}', 'SinglePageController')
    ->where('path', '^(?!api.*$).*')
    ->name('spa');
