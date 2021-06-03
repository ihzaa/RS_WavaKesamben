<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QualityController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\HealthyPromotion\AgendaActivityController as HealthyPromotionAgendaActivityController;
use App\Http\Controllers\User\HealthyPromotion\HealthyInformationController;
use App\Http\Controllers\User\HealthyPromotion\TestimoniController;
use App\Http\Controllers\User\InstagramController;
use App\Http\Controllers\User\QualityController as UserQualityController;
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
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('refresh/patient', [DashboardController::class, 'getUnprocessedPatient'])->name('getUnprocessedPatient');

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

    //Route Kualitas Mutu
    Route::name('kualitas.')->prefix('kualitas')->group(function () {
        Route::get('/', [QualityController::class, 'indexYear'])->name('index.tahun');
        Route::post('add', [QualityController::class, 'addYear'])->name('add.tahun');
        Route::post('edit/{id}', [QualityController::class, 'editYear'])->name('edit.tahun');
        Route::get('delete/{id}', [QualityController::class, 'deleteYear'])->name('delete.tahun');

        //Route Kualitas Mutu Bulan
        Route::get('{id}/', [QualityController::class, 'indexMonth'])->name('index.bulan');
        Route::post('{id}/add', [QualityController::class, 'addMonth'])->name('add.bulan');
        Route::post('edit/{id}/bulan', [QualityController::class, 'editMonth'])->name('edit.bulan');
        Route::get('delete/{id}/bulan', [QualityController::class, 'deleteMonth'])->name('delete.bulan');

        //Route Data Kualitas Mutu
        Route::get('{month_id}/data', [QualityController::class, 'indexData'])->name('index.data');
        Route::post('{month_id}/data/add', [QualityController::class, 'addData'])->name('add.data');
        Route::post('{month_id}/data/{id}/edit', [QualityController::class, 'editData'])->name('edit.data');
        Route::get('{month_id}/data/{id}/delete', [QualityController::class, 'deleteData'])->name('delete.data');

    });

});

Route::name('user.')->group(function () {
    Route::name('quality.')->prefix('kualitas-mutu')->group(function () {
        Route::get('/', [UserQualityController::class, 'showYear'])->name('index');
        Route::get('/{id}-{year}', [UserQualityController::class, 'showMonth'])->name('month');
        Route::get('/{id}-{year}/{month_id}-{month}', [UserQualityController::class, 'showData'])->name('data');
    });

    Route::name('instagram.')->prefix('instagram')->group(function () {
        Route::get('/{id}', [InstagramController::class, 'detail'])->name('index');
    });
    Route::name('healthyPromotion.')->prefix('promosi-kesehatan')->group(function () {
        Route::name('healthyInformation.')->prefix('informasi-kesehatan')->group(function () {
            Route::get('/{id}-{title}', [HealthyInformationController::class, 'detail'])->name('detail');
        });
        Route::name('agendaActivity.')->prefix('agenda-kegiatan')->group(function () {
            Route::get('/{id}-{title}', [HealthyPromotionAgendaActivityController::class, 'detail'])->name('detail');
        });
        Route::name('testimoni.')->prefix('testimoni')->group(function () {
            Route::get('/', [TestimoniController::class, 'index'])->name('index');
        });
    });

    Route::name('contact.')->prefix('kontak-kami')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::post('/add', [ContactController::class, 'addTestimoni'])->name('add');
    });
});
