<?php

use App\Events\NotificationEvent;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('home.index');
});

Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get( '/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::middleware(['auth'])->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
    });
})->name('user');

