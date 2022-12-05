<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsAdmin;
use App\Http\Middleware\CheckIsUser;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\TransaksiController;


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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


//protected routes
Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::get('/barang',[BarangController::class, 'index']);
    Route::get('/barang/{id_barang}',[BarangController::class, 'show']);
    Route::get('/transaksi',[TransaksiController::class, 'index']);
    Route::get('/transaksi/{id_barang}',[TransaksiController::class, 'show']);

    Route::middleware([CheckIsAdmin::class])->group(function () {
        Route::post('/barang', [BarangController::class, 'store']);
        Route::put ('/barang/{id_barang}',[BarangController::class, 'update']);
        Route::delete ('/barang/{id_barang}',[BarangController::class, 'destroy']);
        Route::put('/chatting/balas/{id_chat}',[PesanController::class, 'update']);
    
    });
    Route::middleware([CheckIsUser::class])->group(function () {
        Route::put('/barang/like/{id_barang}', [BarangController::class, 'like']);
        Route::post('/keranjang/{id_barang}', [KeranjangController::class, 'store']);
        Route::post('/chatting',[PesanController::class, 'store']);
        Route::post('/transaksi', [TransaksiController::class, 'store']);
        Route::post('/transaksi/bayar/{id_transaksi}', [TransaksiController::class, 'bayar']);
    });
});


