<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::group(['prefix' => 'v1'], function ($router) {

    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('login', [AuthController::class, 'login']);

        Route::post('register', [AuthController::class, 'register']);
    });

    Route::group(['prefix' => 'post'], function ($router) {
        Route::get('/', [PostController::class, 'show']);

        Route::get('/{id}', [PostController::class, 'index']);

        Route::post('/', [PostController::class, 'store'])->middleware(
            'auth.role:writer'
        );

        Route::put('/{id}', [PostController::class, 'update'])->middleware(
            'auth.role:writer'
        );

        Route::delete('/{id}', [PostController::class, 'delete'])->middleware(
            'auth.role:writer'
        );
    });
});

