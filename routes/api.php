<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [UserController::class,'login']);
    Route::post('signup', [UserController::class,'signup']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [UserController::class,'logout']);
        Route::get('user', [UserController::class,'user']);
    });
});
Route::get('all-user', [UserController::class,'getAllUser']);

Route::prefix('task')->group(function () {
    Route::get('list','TaskController@index');
    Route::post('store','TaskController@store');
    Route::get('show/{id}','TaskController@show');
    Route::put('update/{id}','TaskController@update');
    Route::delete('delete/{id}','TaskController@destroy');
});

Route::prefix('roles')->group(function () {
    Route::get('','RoleController@index');
    Route::post('','RoleController@store');
    Route::get('/{id}','RoleController@show');
    Route::put('/{id}','RoleController@update');
    Route::delete('/{id}','RoleController@destroy');

   
});