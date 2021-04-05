<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('signup', [UserController::class, 'signup'])->name('user.signup');
});

Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'user']);
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('all-user', [UserController::class, 'getAllUser'])->name('user.getAll');
    Route::middleware(['check.Permission'])->group(function () {
        Route::get('projects', [ProjectController::class, 'index'])->name('project.index');
        Route::get('projects/{id}', [ProjectController::class, 'show'])->name('project.show');
        Route::post('projects', [ProjectController::class, 'store'])->name('project.store');
        Route::put('projects/{id}', [ProjectController::class, 'update'])->name('project.update');
        Route::delete('projects/{id}', [ProjectController::class, 'delete'])->name('project.delete');
        Route::get('project', [ProjectController::class, 'search'])->name('project.search');

        Route::prefix('task')->group(function () {
            Route::get('/', 'TaskController@index')->name('task.index');
            Route::post('/', 'TaskController@store')->name('task.store');
            Route::get('/{id}', 'TaskController@show')->name('task.show');
            Route::put('/{id}', 'TaskController@update')->name('task.update');
            Route::delete('/{id}', 'TaskController@delete')->name('task.delete');
        });
        Route::get('tasks', 'TaskController@search')->name('task.search');


        // Route::resource('roles', RoleController::class);
        Route::prefix('roles')->group(function () {
            Route::get('', 'RoleController@index')->name('role.index');
            Route::post('', 'RoleController@store')->name('role.store');
            Route::get('/{id}', 'RoleController@show')->name('role.show');
            Route::put('/{id}', 'RoleController@update')->name('role.update');
            Route::delete('/{id}', 'RoleController@destroy')->name('role.destroy');
        });
        Route::get('permission',[PermissionController::class,'index'])->name('permission.index');
        Route::get('search', [UserController::class, 'searchUser'])->name('user.searchUser');
        Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    });
});