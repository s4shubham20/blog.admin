<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\Admin\{AdminController,CategoryController, PostController,UserController};
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
Route::group(['prefix' => 'admin',  'middleware' => 'auth', 'middleware' => 'isAdmin'], function(){
    Route::resource('dashboard', AdminController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
    Route::resource('user', UserController::class);
});

// Route::middleware(['auth'])->group(['prefix' => 'admin'], function(){

// });

Route::get('/', [FrontController::class ,'index']);
Route::get('category/{slug}', [FrontController::class, 'post']);
Route::get('post/{slug1}/{slug2}', [FrontController::class, 'postdetail']);
