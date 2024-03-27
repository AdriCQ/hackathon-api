<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\UltrasonidoController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/**
 * ------------------------------------------
 *	Users Routes
 * ------------------------------------------
 */
Route::prefix('usuarios')->group(function () {

    /**
     * ------------------------------------------
     *	Authentication routes
     * ------------------------------------------
     */
    Route::prefix('auth')->group(function () {
        // Current User
        Route::get('', [AuthController::class, 'currentUser'])
            ->middleware(['auth:sanctum'])
            ->name('users.current');
        Route::post('login', [AuthController::class, 'login'])
            ->name('login');
        Route::post('register', [AuthController::class, 'register'])
            ->name('register');
    });

    /**
     * ------------------------------------------
     *	Admin Routes
     * ------------------------------------------
     */
    Route::get('filtrar', [UserController::class, 'filter'])
        ->name('users.filter');
});

Route::apiResource('ultrasonidos', UltrasonidoController::class)
    ->except(['update']);
Route::apiResource('medias', MediaController::class)
    ->except(['update']);
