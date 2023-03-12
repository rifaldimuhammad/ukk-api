<?php

use App\Http\Controllers\aktifitasController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\keranjangController;
use App\Http\Controllers\mejaController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\pesananDetailController;
use App\Http\Controllers\userController;
use App\Models\keranjangModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
Route::get('/pesanan/byDate/{date}', [pesananController::class, 'getPesananDate']);
Route::get('/pesanan/pesananWeek', [pesananController::class, 'getPesananWeek']);
Route::get('/pesanan/date/{date}', [pesananController::class, 'getDate']);
Route::get('/tokens', [userController::class, 'getToken']);
Route::post('/pesanan/updateEkstra/{id}', [pesananController::class, 'updateEkstra']);
Route::delete('/destroyCart', [keranjangController::class, 'destroyCart']);
Route::apiResource('/menu', menuController::class);
Route::apiResource('/kategori', kategoriController::class);
Route::apiResource('/keranjang', keranjangController::class);
Route::apiResource('/meja', mejaController::class);
Route::apiResource('/pesanan', pesananController::class);
Route::apiResource('/aktifitas', aktifitasController::class);
Route::apiResource('/pesanan-detail', pesananDetailController::class);
Route::apiResource('/user', userController::class);
