<?php

use App\Http\Controllers\Admin\FeaturedProductController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\testingController;
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

Route::get('u', [testingController::class, 'user']);
Route::get('a', [testingController::class, 'admin']);

Route::get('4dm1n/login', [LoginController::class, 'getLogin'])->name('admin.login.get')->middleware('guest');
Route::post('4dm1n/login', [LoginController::class, 'postLogin'])->name('admin.login.post')->middleware('guest');


Route::name('admin.')->prefix('4dm1n')->middleware(['auth:admin'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return view('admin.template.master');
    })->name('dashboard');

    Route::name('featuredproduct.')->prefix('produk-unggulan')->group(function () {
        Route::get('/', [FeaturedProductController::class, 'index'])->name('index');
        Route::get('add', [FeaturedProductController::class, 'getAdd'])->name('add');
        Route::post('add', [FeaturedProductController::class, 'postAdd'])->name('add.post');
    });
});
