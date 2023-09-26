<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use \App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use \App\Events\ChangeStatusEvent;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->group(function (){
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    Route::middleware(['auth:sanctum', 'is-user'])->group(function (){
        Route::get('', [UserController::class, 'index'])->name('user.dashboard');
    });
})->name('user');

Route::post('/test',function(Request $request){
    try{
        broadcast(new ChangeStatusEvent($request->input('status', 'open')));
        DB::insert('insert into test_data (data) values (?)', [json_encode($request->all())]);
        return ['status' => 'success'];
    }catch(Exception $ex) {
        return ['status' => false, 'error' => $ex];
    }

});
