<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/sendSMS', [SmsController::class, 'index'])->name('index');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin');

Route::get('/addcustomer', [App\Http\Controllers\AdminController::class, 'addCustomer'])->name('addCustomer');
Route::post('/addcustomer', [App\Http\Controllers\AdminController::class, 'addCustomerPost'])->name('addCustomer');

Route::post('/sendSMS', [App\Http\Controllers\SmsController::class, 'SendMsg'])->name('sendSMS');

Route::post('/receiveSMS', [App\Http\Controllers\SmsController::class, 'ReceiveMsg'])->name('receiveSMS');

Route::get('/chat/{id}', [App\Http\Controllers\SmsController::class, 'chat'])->name('chat');