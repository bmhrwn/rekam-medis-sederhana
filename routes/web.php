<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RekamMedis;
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

Route::get('/default', function () {
    return view('welcome');
});

Route::get('/', function () {

});

Route::controller(AuthController::class)->group(function(){
    Route::get('','index')->name('auth');
    Route::post('','login')->name('auth.login');
    Route::get('/logout','logout')->name('auth.logout');
});

Route::middleware('auth')->group(function() {
    Route::get('dashboard', function() {
        $user = Auth::user();
        $pasien = Pasien::count();
        $dokter = Dokter::count();

        $pemeriksaan = RekamMedis::query();
        if($user->roles == 'pasien'){
            $pemeriksaan = $pemeriksaan->leftJoin('pasiens','pasiens.id','=','rekam_medis.patient_id')
            ->where('pasiens.no_ktp', $user->no_ktp);
        }
        if($user->roles == 'staff'){
            $pemeriksaan = $pemeriksaan->leftJoin('dokters','dokters.id','=','rekam_medis.dokter_id')
            ->where('dokters.no_ktp', $user->no_ktp);
        }
        $pemeriksaan = $pemeriksaan->where('rekam_medis.status','PEMERIKSAAN')->count();


        $finish = RekamMedis::query();
        if($user->roles == 'pasien'){
            $finish = $finish->leftJoin('pasiens','pasiens.id','=','rekam_medis.patient_id')
            ->where('pasiens.no_ktp', $user->no_ktp);
        }

        if($user->roles == 'staff'){
            $finish = $finish->leftJoin('dokters','dokters.id','=','rekam_medis.dokter_id')
            ->where('dokters.no_ktp', $user->no_ktp);
        }
        $finish = $finish->where('rekam_medis.status','SELESAI')->count();

        return view('dashboard', compact('pasien','dokter','pemeriksaan','finish'));
    })->name('dashboard');
    
    Route::controller(DokterController::class)->prefix('dokter')->group(function(){
        Route::get('','index')->name('dokter');
        Route::get('/create','create')->name('dokter.create');
        Route::post('','store')->name('dokter.store');
        Route::get('/edit/{id}','edit')->name('dokter.edit');
        Route::put('/{id}','update')->name('dokter.update');
        Route::delete('/{id}','destroy')->name('dokter.destroy');
    });

    Route::controller(PasienController::class)->prefix('pasien')->group(function(){
        Route::get('','index')->name('pasien');
        Route::get('/create','create')->name('pasien.create');
        Route::post('','store')->name('pasien.store');
        Route::delete('/{id}','destroy')->name('pasien.destroy');
        Route::get('/update/{id}','edit')->name('pasien.edit');
        Route::put('/{id}','update')->name('pasien.update');
    });

    Route::controller(RekamMedisController::class)->prefix('rekam-medis')->group(function (){
        Route::get('','index')->name('rekamMed');
        Route::get('/create','create')->name('rekamMed.create');
        Route::post('','store')->name('rekamMed.store');
        Route::get('/{id}','edit')->name('rekaMed.edit');
        Route::put('/{id}','update')->name('rekamMed.update');
        Route::delete('/{id}','destroy')->name('rekamMed.destroy');
        Route::put('/finish/{id}','finish')->name('rekamMed.finish');
    });

    Route::controller(UserController::class)->prefix('users')->group( function () {
        Route::get('','index')->name('user');
        Route::get('/create','create')->name('user.create');
        Route::post('','store')->name('user.store');
        Route::get('/edit/{id}','edit')->name('user.edit');
        Route::put('/{id}','update')->name('user.update');
        Route::delete('/{id}','destroy')->name('user.destroy');
    });
});


