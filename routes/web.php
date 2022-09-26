<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

// User Routes

Route::controller(UserController::class)->name('user.')->group(function(){
    Route::get('/','welcome')->name('welcome');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/services','services')->name('services');
    Route::get('/about','about')->name('about');
    Route::get('/contact','contact')->name('contact');
});


// Admin Routes

Route::resource('admin/category',CategoryController::class);
Route::resource('admin/product',ProductController::class);

Auth::routes();



Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List - Admin
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

});

/*------------------------------------------
--------------------------------------------
All Admin Routes List - Manager
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

