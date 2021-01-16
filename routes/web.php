<?php

use App\Http\Controllers\CinemasController;
use App\Http\Controllers\SearchController;
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

    Route::middleware(['customer'])->group( function () {
        Route::get('/', [ SearchController::class, 'index' ]);
        Route::post('/sessions/search', [ SearchController::class, 'search' ]);
        Route::get('/sessions/booking/{id}', [ SearchController::class, 'booking' ]);
        Route::post('/sessions/booking/{id}', [ SearchController::class, 'book' ]);
    });
});
