<?php

use App\Http\Controllers\Api\V1\System\NewsController;
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

Route::group(['prefix' => 'news'], function () {
    Route::get('/', [NewsController::class, 'getAll']);
    Route::post('/create', [NewsController::class, 'create']);
    Route::group(['prefix' => '/{id}'], function () {
        Route::post('/update', [NewsController::class, 'update']);
        Route::post('/delete', [NewsController::class, 'delete']);
    });
});
