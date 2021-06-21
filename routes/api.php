<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\FlightsGroupController;

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


Route::group(array('prefix' => 'v1'), function()
{
    Route::post('/auth/register', [AuthController::class, 'register']);

    Route::get('/', function () {
        return response()->json(['status' => 'Error', 'message' => 'Connected', 'data' => 'API de Voos']);
    });

    Route::get('/login', function () {
        return response()->json(['status' => 'Forbidden', 'message' => 'Error', 'data' => 'É obrigatório informar um Authorization Bearer válido para realizar a requisição.'], 403);
    })->name('login');

    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::get('/me', function(Request $request) {
            return auth()->user();
        });

        Route::resource('flights', FlightsController::class);

        Route::resource('group', FlightsGroupController::class);
    });
});
