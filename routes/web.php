<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KetuaController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [DashboardController::class, 'index'])->name ('dashboard')->middleware('auth');
Route::get('/mylink', [FrontendController::class, 'index'])->name('link-user')->middleware('auth');
Route::get('/', [FrontendController::class, 'officelinks'])->name('link-kantor');
Route::resource('links', LinksController::class)->middleware('auth');
Route::resource('ketua', KetuaController::class)->middleware('admin');
Route::resource('users', UsersController::class)->middleware('admin');
Route::resource('category', CategoryController::class)->middleware('admin');
Route::resource('office', OfficeController::class)->middleware('admin');
