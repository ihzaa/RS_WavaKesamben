<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ProfileController;
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
//Admin
Route::name('admin.')->prefix('4dm1n')->middleware(['auth:admin'])->group(function () {
    //Route menu profile
    Route::name('profile.')->prefix('profil')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('add', [ProfileController::class, 'getAdd'])->name('add');
        Route::post('add', [ProfileController::class, 'postAdd'])->name('add.post');
        Route::get('edit/{id}', [ProfileController::class, 'getEdit'])->name('edit');
        Route::post('edit/{id}', [ProfileController::class, 'postEdit'])->name('edit.post');
        Route::get('delete/{id}', [ProfileController::class, 'delete'])->name('delete');
    });
    //Route klinik spesialis
    Route::name('department.')->prefix('spesialis')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('add', [DepartmentController::class, 'getAdd'])->name('add');
        Route::post('add', [DepartmentController::class, 'postAdd'])->name('add.post');
        Route::get('edit/{id}', [DepartmentController::class, 'getEdit'])->name('edit');
        Route::post('edit/{id}', [DepartmentController::class, 'postEdit'])->name('edit.post');
        Route::get('delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
    });

});
