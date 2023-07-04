<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
session_start(); 
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
    return view('welcome');
});
Route::post('staff_auth',[UserController::class,'staff_auth']);
Route::get('dashboard',[UserController::class,'dashboard']);
Route::get('view_section',[UserController::class,'view_section']);
Route::post('verify',[UserController::class,'verify']);
Route::post('insbio',[UserController::class,'insbio']);
Route::post('view',[UserController::class,'view']);
Route::post('delete',[UserController::class,'delete']);
Route::get('logout',[UserController::class,'logout']);
