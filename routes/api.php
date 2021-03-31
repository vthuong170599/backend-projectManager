<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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


/**
 * router user
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
Route::get('user/{id}', [UserController::class,'show']);
Route::get('search',[UserController::class,'searchUser']);
Route::put('user/{id}',[UserController::class,'update']);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


/**
 * router project
 */
Route::get('projects',[ProjectController::class,'index']);
Route::get('projects/{id}', [ProjectController::class,'show']);
Route::post('projects', [ProjectController::class,'store']);
Route::put('projects/{id}', [ProjectController::class,'update']);
Route::delete('projects/{id}', [ProjectController::class,'delete']);
Route::get('project', [ProjectController::class,'search']);

/**
 * router task
 */
Route::prefix('task')->group(function () {
    Route::get('/',[TaskController::class,'index']);
    Route::post('/',[TaskController::class,'store']);
    Route::get('/{id}',[TaskController::class,'show']);
    Route::put('/{id}',[TaskController::class,'update']);
    Route::delete('/{id}',[TaskController::class,'destroy']);
    Route::get('',[TaskController::class,'search']);
});

/**
 * router roles
 */
Route::resource('roles',RoleController::class);
Route::prefix('roles')->group(function () {
    Route::get('','RoleController@index');
    Route::post('','RoleController@store');
    Route::get('/{id}','RoleController@show');
    Route::put('/{id}','RoleController@update');
    Route::delete('/{id}','RoleController@destroy');
});

