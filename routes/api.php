<?php

use App\Http\Controllers\invoiceController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\mejaController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\userController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [userController::class, 'register']);
Route::post('/login', [userController::class, 'login']);
Route::post('/logout', [userController::class, 'logout'])->middleware('auth:api');

Route::get('/menu/kategori/{category}', [menuController::class, 'showByCat']);
Route::get('/invoice/byDate/{date}', [invoiceController::class, 'getInvoiceDate']);
// Route::get('/invoice/byDateNow', [invoiceController::class, 'getInvoiceDateNow']);
Route::apiResource('/menu', menuController::class);
Route::apiResource('/kategori', kategoriController::class);
Route::apiResource('/pesanan', pesananController::class);
Route::apiResource('/meja', mejaController::class);
Route::apiResource('/invoice', invoiceController::class);
Route::apiResource('/user', userController::class);
