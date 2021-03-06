<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');


// * auth routes
Route::get('register', [RegisterController::class, 'index'])->name('auth.register');
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'index'])->name('auth.login');
Route::post('login', [LoginController::class, 'store']);

Route::post('logout', [LogoutController::class, 'index'])->name('auth.logout');


// * ticket routes
Route::group(['middleware' => 'auth', 'prefix' => 'tickets'], function () {
    Route::get('', [TicketController::class, 'index'])->name('tickets.index');

    Route::get('create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('create', [TicketController::class, 'store']);

    Route::get('{ticket_id}/answer', [TicketController::class, 'answer'])->name('tickets.answer');

    Route::post("{ticket_id}/status", [TicketController::class, 'status'])->name('tickets.status');

    Route::post('answer', [AnswerController::class, 'store'])->name('answer.store');
});

// * service routes
Route::group(['middleware' => 'admin', 'prefix' => 'services'], function () {
    Route::get('', [ServiceController::class, 'index'])->name('services.index');
    Route::post('create', [ServiceController::class, 'store'])->name('services.create');
    Route::post('update', [ServiceController::class, 'update'])->name('services.update');
});

// * status routes
Route::group(['middleware' => 'admin', 'prefix' => 'statuses'], function () {
    Route::get('', [StatusController::class, 'index'])->name('statuses.index');
    Route::post('create', [StatusController::class, 'store'])->name('statuses.create');
    Route::post('update', [StatusController::class, 'update'])->name('statuses.update');
});
