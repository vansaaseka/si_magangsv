<?php

use App\Http\Controllers\AjuanMagangController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAjuanMahasiswaController;
use App\Http\Controllers\ManajemenUser\AdminController;
use App\Http\Controllers\ManajemenUser\CDCController;
use App\Http\Controllers\ManajemenUser\DekanatController;
use App\Http\Controllers\ManajemenUser\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitController;
use App\Models\AjuanMagang;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




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

Route::get('/', function () {
    return view('landingpage');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth/login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register/post', [RegisterController::class, 'register'])->name('register.post');
});

//mahasiswa
Route::middleware(['auth'])->group(function () {

    Route::prefix('/')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/pengajuanmagang', [AjuanMagangController::class, 'index'])->name('pengajuanmahasiswa');
        Route::post('/ajuan', [AjuanMagangController::class, 'store'])->name('ajuan');
    });

    //Superadmin-cdc
    Route::prefix('/dataprodi')->name('dataprodi.')->group(function () {
        Route::get('/', [UnitController::class, 'index']);
        Route::post('/store', [UnitController::class, 'store'])->name('store');
        Route::post('/update/{id}', [UnitController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UnitController::class, 'destroy'])->name('delete');
    });




    //Manajemen User
    //Mahasiswa
    Route::prefix('/datamahasiswa')->name('datamahasiswa.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('index');
        Route::post('/store', [MahasiswaController::class, 'store'])->name('store');
        Route::post('/update/{id}', [MahasiswaController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [MahasiswaController::class, 'destroy'])->name('delete');
    });

    //Tim CDC
    Route::prefix('/datatimcdc')->name('datatimcdc.')->group(function () {
        Route::get('/', [CDCController::class, 'index'])->name('index');
        Route::post('/store', [CDCController::class, 'store'])->name('store');
        Route::post('/update/{id}', [CDCController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CDCController::class, 'destroy'])->name('delete');
    });

    //Admin
    Route::prefix('/dataadmin')->name('dataadmin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('delete');
    });

    //Dekanat
    Route::prefix('/datadekanat')->name('datadekanat.')->group(function () {
        Route::get('/', [DekanatController::class, 'index'])->name('index');
        Route::post('/store', [DekanatController::class, 'store'])->name('store');
        Route::post('/update/{id}', [DekanatController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DekanatController::class, 'destroy'])->name('delete');
    });




    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



    Route::prefix('/datapengajuan')->name('datapengajuan.')->group(function()
    {
        Route::get('/', [DataAjuanMahasiswaController::class, 'index'])->name('index');
        Route::put('/update/{id}', [DataAjuanMahasiswaController::class, 'update'])->name('update');
        Route::put('admin/update/{id}', [DataAjuanMahasiswaController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [DataAjuanMahasiswaController::class, 'delete'])->name('delete');
    });

    Route::get('/success', [AjuanMagangController::class, 'success'])->name('viewsuccess');
});
