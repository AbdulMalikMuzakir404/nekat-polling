<?php

use App\Http\Controllers\Auth\LoginApiController;
use App\Http\Controllers\Siswa\CalonOsisApiController;
use App\Http\Controllers\Siswa\VoteApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [LoginApiController::class, 'login']);
    // Route::post('/register', [AuthController::class, 'register']);
    Route::get('/profile', [LoginApiController::class, 'profile'])->middleware('auth:sanctum');
    Route::post('/logout', [LoginApiController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'siswa', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/vote/{id}', [VoteApiController::class, 'vote']);
    Route::get('/calon-osis', [CalonOsisApiController::class, 'calonOsis']);
});
