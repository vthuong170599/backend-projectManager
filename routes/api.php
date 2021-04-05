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
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('projects',[ProjectController::class,'index']);
Route::get('projects/{id}', [ProjectController::class,'show']);
Route::post('projects', [ProjectController::class,'store']);
Route::put('projects/{id}', [ProjectController::class,'update']);
Route::delete('projects/{id}', [ProjectController::class,'delete']);
Route::get('project', [ProjectController::class,'search']);
Route::get('project/get/{id}', [ProjectController::class,'getTaskOfProject']);
Route::get('all-user', [UserController::class,'getAllUser']);
Route::get('search', [UserController::class,'searchUser']);
Route::get('user/{id}',[UserController::class,'show']);
Route::put('user/{id}',[UserController::class,'update']);
Route::get('user/get/{id}',[UserController::class,'getTaskOfUser']);


Route::prefix('task')->group(function () {
    Route::get('/','TaskController@index');
    Route::post('/','TaskController@store');
    Route::get('/{id}','TaskController@show');
    Route::put('/{id}','TaskController@update');
    Route::delete('/{id}','TaskController@delete');
  

});
Route::get('tasks','TaskController@search');

Route::prefix('roles')->group(function () {
    Route::get('','RoleController@index');
    Route::post('','RoleController@store');
    Route::get('/{id}','RoleController@show');
    Route::put('/{id}','RoleController@update');
    Route::delete('/{id}','RoleController@destroy');
    Route::get('','RoleController@search');
});
