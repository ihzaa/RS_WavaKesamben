<?php

use App\Http\Controllers\Admin\FeaturedProductController;
use App\Http\Controllers\Admin\Home\CarouselController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\testingController;
use App\Http\Controllers\User\FeaturedProductController as UserFeaturedProductController;
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
        Route::get('edit/{id}', [FeaturedProductController::class, 'getEdit'])->name('edit');
        Route::post('edit/{id}', [FeaturedProductController::class, 'postEdit'])->name('edit.post');
        Route::post('delete', [FeaturedProductController::class, 'delete'])->name('delete');
    });

    Route::name('home.')->prefix('home')->group(function () {
        Route::name('carousel.')->prefix('carousel')->group(function () {
            Route::get('/', [CarouselController::class, 'index'])->name('index');
            Route::post('/add', [CarouselController::class, 'add'])->name('add.post');
            Route::post('/edit/{id}', [CarouselController::class, 'edit'])->name('edit.post');
            Route::post('delete', [CarouselController::class, 'delete'])->name('delete');
        });
    });
});

Route::name('user.')->group(function () {
    Route::get('produk-unggulan/{id}/{title}', [UserFeaturedProductController::class, 'index'])->name('featuredproduct.index');
});
