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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/customers', [App\Http\Controllers\CustomersController::class, 'index']);


Route::get('/customer_edit/{id}', [App\Http\Controllers\CustomersController::class, 'edit']);
Route::post('/sendmessage', [App\Http\Controllers\CustomersController::class, 'sendmessage']);

Route::get('/services', [App\Http\Controllers\ServicesController::class, 'index']);