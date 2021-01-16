<?php

use App\Http\Controllers\CinemasController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['web', 'auth'])->group(function () {
    Route::middleware(['admin'])->group( function () {
        Route::get('/', [ CinemasController::class, 'index' ]);

        Route::resources([
            'cinemas' => 'CinemasController',
            'halls' => 'HallsController',
            'movies' => 'MoviesController',
            'sessions' => 'SessionsController'
        ]);
    });
});
