<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Peoples\PeopleController;
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

Route::get('/', [AuthController::class,'loginBlade'])->name('loginBlade');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'admin','as' => 'admin.','middleware' => ['auth:sanctum','role:admin']], function (){
    Route::get('/',[AuthController::class,'index'])->name('index');
   Route::get('peoples',[PeopleController::class,'index'])->name('peoples');
   Route::get('appeals',[PeopleController::class,'appeals'])->name('appeals');
});
