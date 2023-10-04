<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LabelController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('showTicket',[TicketController::class,'showAlltickets']);
Route::get('showCategories',[CategoryController::class,'index']);
Route::get('showLabels',[LabelController::class,'index']);

Route::middleware('auth:sanctum')->group(function (){
Route::get('Tickets',[TicketController::class,'index']);
Route::post('Create_Ticket',[TicketController::class,'store']);
Route::get('Show_Ticket/{id}',[TicketController::class,'show']);
Route::put('Edite/{id}',[TicketController::class,'update']);
Route::get('/succes',[StripeController::class,'succes'])->name('succes');
Route::get('/',[StripeController::class,'index'])->name('index');
Route::post('/checkout',[StripeController::class,'checkout'])->name('checkout');
});

