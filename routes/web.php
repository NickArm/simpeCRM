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
Route::get('/customer_edit/{id}', [App\Http\Controllers\CustomersController::class, 'edit'])->name('customer_edit')->middleware('auth');
Route::post('/customer_add', [App\Http\Controllers\CustomersController::class, 'store'])->middleware('auth');

/* ------ services routes ------ */
Route::get('/services', [App\Http\Controllers\ServicesController::class, 'index'])->name('services.index');
Route::post('/service_add', [App\Http\Controllers\ServicesController::class, 'store'])->middleware('auth');
Route::get('/services/{service}/edit', [App\Http\Controllers\ServicesController::class, 'edit'])->name('services.edit');
Route::put('/services/{service}', [App\Http\Controllers\ServicesController::class, 'update'])->name('services.update');
Route::delete('/services/{service}', [App\Http\Controllers\ServicesController::class, 'destroy'])->name('services.destroy');

/* ------ payments routes ------ */
Route::get('/payments', [App\Http\Controllers\PaymentsController::class, 'index'])->middleware('auth');
Route::post('/addpayment', [App\Http\Controllers\PaymentsController::class, 'store'])->middleware('auth');

/* ------ email routes ------ */
Route::post('/sendmessage', [App\Http\Controllers\CustomersController::class, 'sendmessage'])->middleware('auth');

/* ------ servicetocustomer routes ------ */
Route::post('/addservicetocustomer', [App\Http\Controllers\ServicetoCustomerController::class, 'store'])->name('addservicetocustomer')->middleware('auth');
Route::get('/servicetocustomer/{servicetocustomer}/edit', [App\Http\Controllers\ServicetoCustomerController::class, 'edit'])->name('servicetocustomer.edit');
Route::put('/servicetocustomer/{servicetocustomer}', [App\Http\Controllers\ServicetoCustomerController::class, 'update'])->name('servicetocustomer.update');
Route::delete('/servicetocustomer/{servicetocustomer}', 'App\Http\Controllers\ServicetoCustomerController@destroy')->name('servicetocustomer.destroy');
Route::post('/servicetocustomer/update_reminder_status', 'App\Http\Controllers\ServicetoCustomerController@updateReminderStatus')->name('servicetocustomer.update_reminder_status');

Route::post('/service/{id}/renew', [App\Http\Controllers\ServicetoCustomerController::class, 'renewService'])->name('service.renew');
