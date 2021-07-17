<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\EntryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
// Route::post('/register',[ApiAuthController::class ,'register'])->name('register.api');


Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
    Route::get('/fetchTableData', [EntryController::class, 'index'])->name('fetchTableData.api');
    Route::get('/getPicture/{filename}', [EntryController::class, 'getPicture'])->name('getPicture.api'); 
});
Route::post('/store', [EntryController::class, 'store'])->name('store.api');
