<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactosController;
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


Route::group([
    'middleware' => ['api', 'cors'],
    'prefix' => 'auth',
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('contactos', [ContactosController::class, 'index']);
    Route::get('contactosbyid/{id}', [ContactosController::class, 'show']);
    Route::post('contactoscreate', [ContactosController::class, 'store']);
    Route::put('updatecontacto/{id}', [ContactosController::class, 'update']);
    Route::put('deletecontacto/{id}', [ContactosController::class, 'destroy']);
});