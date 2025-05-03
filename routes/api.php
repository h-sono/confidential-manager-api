<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TestController;

// ログイン
Route::post('/login', [AuthController::class, 'login']);

// アカウント登録
Route::post('/add_user', [AuthController::class, 'addUser']);

// TODO:テスト用テーブル参照ルート
Route::post('/show_table', [TestController::class, 'showTable']);

// Laravel Sanctum（トークン認証）
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // テストAPI（POST）
    Route::post('/test_post', [TestController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/passwords', [PasswordController::class, 'store']);
    Route::get('/passwords', [PasswordController::class, 'index']);
});
