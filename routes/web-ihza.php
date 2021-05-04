<?php

use App\Http\Controllers\Admin\FeaturedProductController;
use App\Http\Controllers\Admin\HealthyPromotion\AgendaActivityController;
use App\Http\Controllers\Admin\HealthyPromotion\HealthyInfoController;
use App\Http\Controllers\Admin\Home\AngketController;
use App\Http\Controllers\Admin\Home\CarouselController;
use App\Http\Controllers\Admin\Home\GaleriController;
use App\Http\Controllers\Admin\Home\InstagramController;
use App\Http\Controllers\Admin\Home\SambutanDirekturController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PendaftaranPasien\PasienController;
use App\Http\Controllers\Admin\PendaftaranPasien\RegistrationMenuController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\testingController;
use App\Http\Controllers\User\FeaturedProductController as UserFeaturedProductController;
use App\Models\Angket;
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

Route::get('email/pasien/acc', function () {
    return view('admin.email.patientRegistration.accepted');
});
Route::get('email/pasien/rej', function () {
    return view('admin.email.patientRegistration.rejected');
});

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

        Route::name('sambutanDirektur.')->prefix('sambutan-direktur')->group(function () {
            Route::get('/', [SambutanDirekturController::class, 'index'])->name('index');
            Route::post('edit', [SambutanDirekturController::class, 'edit'])->name('edit');
        });

        Route::name('angket.')->prefix('angket')->group(function () {
            Route::get('/', [AngketController::class, 'index'])->name('index');
            Route::post('add/question', [AngketController::class, 'addQuestion'])->name('add.question');
            Route::post('edit/{id}/question', [AngketController::class, 'editQuestion'])->name('edit.question');
            Route::get('delete/{id}/question', [AngketController::class, 'deleteQuestion'])->name('delete.question');

            Route::get('answare/{id}', [AngketController::class, 'getAnswarePerQuestion'])->name('get.answare');
            Route::post('answare/add/{id}', [AngketController::class, 'addAnsware'])->name('add.answare');
            Route::get('{question}/answare/{id}/delete', [AngketController::class, 'deleteAnsware'])->name('delete.answare');
        });

        Route::name('galeri.')->prefix('galeri')->group(function () {
            Route::get('/', [GaleriController::class, 'index'])->name('index');
            Route::post('add/{id}', [GaleriController::class, 'add'])->name('add');
            Route::get('remove/{id}', [GaleriController::class, 'remove'])->name('remove');
        });

        Route::name('instagram.')->prefix('instagram')->group(function () {
            Route::get('/', [InstagramController::class, 'index'])->name('index');
            Route::get('add', [InstagramController::class, 'getAdd'])->name('add');
            Route::post('add', [InstagramController::class, 'postAdd'])->name('add.post');
            Route::get('edit/{id}', [InstagramController::class, 'getEdit'])->name('edit');
            Route::post('edit/{id}', [InstagramController::class, 'postEdit'])->name('edit.post');
            Route::get('delete/{id}', [InstagramController::class, 'delete'])->name('delete');
        });
    });

    Route::name('services.')->prefix('layanan')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('add', [ServiceController::class, 'getAdd'])->name('add');
        Route::post('add', [ServiceController::class, 'postAdd'])->name('add.post');
        Route::get('edit/{id}', [ServiceController::class, 'getEdit'])->name('edit');
        Route::post('edit/{id}', [ServiceController::class, 'postEdit'])->name('edit.post');
        Route::get('delete/{id}', [ServiceController::class, 'delete'])->name('delete');
    });

    Route::name('patientRegistration.')->prefix('pendaftaran-pasien')->group(function () {
        Route::name('listPatient.')->prefix('pasien')->group(function () {
            Route::get('/', [PasienController::class, 'index'])->name('index');
            Route::get('/registration/accept/{id}', [PasienController::class, 'acceptRegistration'])->name('accept.registration');
            Route::get('/registration/reject/{id}', [PasienController::class, 'rejectRegistration'])->name('reject.registration');
        });

        Route::name('registrationMenu.')->prefix('menu-registrasi')->group(function () {
            Route::get('/', [RegistrationMenuController::class, 'index'])->name('index');
            Route::get('add', [RegistrationMenuController::class, 'getAdd'])->name('add');
            Route::post('add', [RegistrationMenuController::class, 'postAdd'])->name('add');
            Route::get('change/status/{id}', [RegistrationMenuController::class, 'changeStatus'])->name('changeStatus');
            Route::get('delete/{id}', [RegistrationMenuController::class, 'delete'])->name('delete');
            Route::get('edit/{id}', [RegistrationMenuController::class, 'getEdit'])->name('edit');
            Route::post('edit/{id}', [RegistrationMenuController::class, 'postEdit'])->name('edit.post');
        });
    });

    Route::name('healthyPromotion.')->prefix('promosi-kesehatan')->group(function () {
        Route::name('healthyInfo.')->prefix('info-kesehatan')->group(function () {
            Route::get('/', [HealthyInfoController::class, 'index'])->name('index');
            Route::get('add', [HealthyInfoController::class, 'getAdd'])->name('add');
            Route::post('add', [HealthyInfoController::class, 'postAdd'])->name('add.post');
            Route::get('edit/{id}', [HealthyInfoController::class, 'getEdit'])->name('edit');
            Route::post('edit/{id}', [HealthyInfoController::class, 'postEdit'])->name('edit.post');
            Route::get('delete/{id}', [HealthyInfoController::class, 'delete'])->name('delete');
        });
        Route::name('agendaActivity.')->prefix('agenda-kegiatan')->group(function () {
            Route::get('/', [AgendaActivityController::class, 'index'])->name('index');
            Route::get('add', [AgendaActivityController::class, 'getAdd'])->name('add');
            Route::post('add', [AgendaActivityController::class, 'postAdd'])->name('add.post');
            Route::get('edit/{id}', [AgendaActivityController::class, 'getEdit'])->name('edit');
            Route::post('edit/{id}', [AgendaActivityController::class, 'postEdit'])->name('edit.post');
            Route::get('delete{id}', [AgendaActivityController::class, 'delete'])->name('delete');
        });
    });
});

Route::name('user.')->group(function () {
    Route::get('produk-unggulan/{id}/{title}', [UserFeaturedProductController::class, 'index'])->name('featuredproduct.index');
});
