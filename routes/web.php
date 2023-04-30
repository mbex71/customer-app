<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'loginPage']);
Route::get('login', [AuthController::class, 'loginPage']);
Route::post('login', [AuthController::class, 'login']);
Route::get('signup', [AuthController::class, 'registerPage']);
Route::post('signup', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function(){
    
    Route::get('home', [MainController::class, 'home']);
    Route::prefix('customer')->group(function(){
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('create', [CustomerController::class, 'create']);
        Route::post('store', [CustomerController::class, 'store']);
        Route::get('edit/{id}', [CustomerController::class, 'edit']);
        Route::post('update/{id}', [CustomerController::class, 'update']);
        Route::delete('delete/{id}', [CustomerController::class, 'destroy']);
        Route::get('ajaxCustomer', [CustomerController::class, 'ajaxCustomer'])->name('getCustomer');
    });

    Route::prefix('user')->group(function(){
        Route::get('/', [UserController::class, 'index']);
        Route::get('create', [UserController::class, 'create']);
        Route::post('store', [UserController::class, 'store']);
        Route::get('edit/{id}', [UserController::class, 'edit']);
        Route::post('update/{id}', [UserController::class, 'update']);
        Route::delete('delete/{id}', [UserController::class, 'destroy']);
    });
    
});
