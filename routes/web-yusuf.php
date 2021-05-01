<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ScheduleController;
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

        //Route dokter spesialis
        Route::get('{id}/dokter', [DoctorController::class, 'index'])->name('doctor.index');
        Route::get('{id}/dokter/add', [DoctorController::class, 'getAdd'])->name('doctor.add');
        Route::post('{id}/dokter/add', [DoctorController::class, 'postAdd'])->name('doctor.add.post');
        Route::get('{id}/dokter/edit/{dokter_id}', [DoctorController::class, 'getEdit'])->name('doctor.edit');
        Route::post('{id}/dokter/edit/{dokter_id}', [DoctorController::class, 'postEdit'])->name('doctor.edit.post');
        Route::get('{id}/dokter/delete/{dokter_id}', [DoctorController::class, 'delete'])->name('doctor.delete');
    });

    //Route Jadwal Dokter
    Route::name('jadwal.')->prefix('jadwal')->group(function () {
        Route::get('{dokter_id}/', [ScheduleController::class, 'index'])->name('index');
        Route::post('add', [ScheduleController::class, 'add'])->name('add');
        Route::post('edit/{id}', [ScheduleController::class, 'edit'])->name('edit');
        Route::get('delete/{id}', [ScheduleController::class, 'delete'])->name('delete');
    });

});
