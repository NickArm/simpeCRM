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

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->middleware('auth');

Auth::routes();

Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/* ------ customers routes ------ */
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Route::get('/customers', [App\Http\Controllers\CustomersController::class, 'index'])->middleware('auth');
Route::get('/customer_edit/{id}', [App\Http\Controllers\CustomersController::class, 'edit'])->middleware('auth');
Route::post('/customer_add', [App\Http\Controllers\CustomersController::class, 'store'])->middleware('auth');

/* ------ services routes ------ */
Route::get('/services', [App\Http\Controllers\ServicesController::class, 'index'])->middleware('auth');
Route::post('/service_add', [App\Http\Controllers\ServicesController::class, 'store'])->middleware('auth');
/* ------ email routes ------ */
Route::post('/sendmessage', [App\Http\Controllers\CustomersController::class, 'sendmessage'])->middleware('auth');

/* ------ servicetocustomer routes ------ */
Route::post('/addservicetocustomer', [App\Http\Controllers\ServicetoCustomer::class, 'store'])->middleware('auth');
Route::post('/delete_service_from_user', [App\Http\Controllers\ServicetoCustomer::class, 'delete_service_from_user'])->middleware('auth');
