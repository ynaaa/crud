<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['guest']], function(){
	// Route::get('/', function () {
	// 	return view('layouts.list');
	// });

	Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('list');
	Route::post('/edit-info', [App\Http\Controllers\UserController::class, 'editInfo'])->name('edit-info');
	Route::post('/delete-info', [App\Http\Controllers\UserController::class, 'deleteInfo'])->name('delete-info');
	Route::post('/insert-info', [App\Http\Controllers\UserController::class, 'insertInfo'])->name('insert-info');
	Route::post('/get-Info', [App\Http\Controllers\UserController::class, 'getInfo'])->name('get-Info');
});


