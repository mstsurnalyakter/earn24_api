<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepositeController;
use App\Http\Controllers\DepositInfoController;
use App\Http\Controllers\UsersAuthController;
use App\Http\Controllers\WithdrawController;
use App\Models\DepositInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// user authentication
Route::post('signup', [UsersAuthController::class, 'signup']);
Route::post('login', [UsersAuthController::class, 'login']);

Route::controller(UsersAuthController::class)->group(function(){
    Route::resource('admin', AdminController::class);
});

// deposit routes
Route::post('add-deposit',[DepositInfoController::class,'addDeposit']);
Route::get('deposits',[DepositInfoController::class,'index']);
Route::put('/deposits/{id}/status',[DepositInfoController::class,'updateStatus']);

// withdraw routes
Route::post('add-withdraw',[WithdrawController::class,'addWithdraw']);