<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;

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
Auth::routes();
Route::get('/', function () {
    return view('auth/login');
});
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
});

Route::resource('blog', BlogController::class);
Route::post('/likeBlog', [App\Http\Controllers\BlogController::class, 'likeBlog'])->name('like-blog');
Route::get('/searchBlog',[App\Http\Controllers\BlogController::class,'searchCategory']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


