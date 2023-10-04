<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/stripe', [StripeController::class,'stripe']);
Route::post('payment', [StripeController::class,'payStripe'])->name('payment');

Route::get('/succes',[StripeController::class,'succes'])->name('succes');
Route::get('/',[StripeController::class,'index'])->name('index');
Route::post('/checkout',[StripeController::class,'checkout'])->name('checkout');
