<?php

use App\Http\Controllers\UsersAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// user authentication
Route::post('signup', [UsersAuthController::class, 'signup']);
Route::post('login', [UsersAuthController::class, 'login']);
