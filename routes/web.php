<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\Admin\GasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Supir\ScanController;
use App\Http\Controllers\Admin\SopirController;
use App\Http\Controllers\Admin\RelasiController;

use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\TipeGasController;
use App\Http\Controllers\Admin1\HomeAdmin1Controller;
use App\Http\Controllers\Admin2\HomeAdmin2Controller;
use App\Http\Controllers\Admin3\HomeAdmin3Controller;
use App\Http\Controllers\Admin\SearchBarcodeController;
use App\Http\Controllers\SuperAdmin\HakAksesController;
use App\Http\Controllers\SuperAdmin\KaryawanController;
use App\Http\Controllers\SuperAdmin\SuratMasukController;
use App\Http\Controllers\Admin1\SuratMasukAdmin1Controller;
use App\Http\Controllers\Admin2\SuratMasukAdmin2Controller;
use App\Http\Controllers\Admin3\SuratMasukAdmin3Controller;
use App\Http\Controllers\SuperAdmin\JabatanBidangController;
use App\Http\Controllers\SuperAdmin\HomeSuperAdminController;
use App\Http\Controllers\Supir\LaporanController as LaporanSupirController;
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
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('admin.dashboard.index');
});

Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('authlogin', function () {

        if(auth()->user()->jabatan_id == '1'){
            return redirect()->route('superadmin.home.index');
        }else if(auth()->user()->jabatan_id == '2'){
            return redirect()->route('admin1.home.index');
        }else if(auth()->user()->jabatan_id == '3'){
            return redirect()->route('admin2.home.index');
        }else if(auth()->user()->jabatan_id == '4'){
            return redirect()->route('admin3.home.index');
        }else if(auth()->user()->jabatan_id == '5'){
            return redirect()->route('user1.dashboard.index');
        }else if(auth()->user()->jabatan_id == '6'){
            return redirect()->route('user2.dashboard.index');
        }else {
            return redirect()->route('login');
        }
    });

    Route::group([
        'middleware' => 'role.admin'
    ], function () {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

            Route::resource('sopir', SopirController::class);
            Route::resource('gas', GasController::class);
            Route::resource('tipe-gas', TipeGasController::class);
            Route::resource('relasi', RelasiController::class);
            Route::resource('laporan', LaporanController::class);
            Route::resource('dashboard', DashboardController::class);
            Route::resource('searchbarcode', SearchBarcodeController::class);

        });

    });

    Route::group([
        'middleware' => 'role.supir'
    ], function () {

        Route::group(['prefix' => 'supir', 'as' => 'supir.'], function () {
            
            Route::resource('scan', ScanController::class);
            Route::resource('laporan', LaporanSupirController::class);
        });

    });

    //role superadmin
    Route::group([
        'middleware' => 'role.superadmin'
    ], function () {

        Route::group(['prefix' => 'superadmin', 'as' => 'superadmin.'], function () {
            
            Route::resource('home', HomeSuperAdminController::class);
            //hakakses
            Route::resource('hakakses', HakAksesController::class);
            //jabatanbidang
            Route::resource('jabatan', JabatanBidangController::class);
            //karyawan
            Route::resource('karyawan', KaryawanController::class);
            //suratmasuk
            Route::resource('suratmasuk', SuratMasukController::class);
            Route::get('surat-masuk/detail', [SuratMasukController::class, 'detail_surat'])->name('suratmasuk.detail');

        });

    });

    //role admin1
    Route::group([
        'middleware' => 'role.admin1'
    ], function () {

        Route::group(['prefix' => 'admin1', 'as' => 'admin1.'], function () {
            
            Route::resource('home', HomeAdmin1Controller::class);
            //Surat Masuk
            Route::resource('suratmasukadmin1', SuratMasukAdmin1Controller::class);
           
        });

    });

    //role admin2
    Route::group([
        'middleware' => 'role.admin2'
    ], function () {

        Route::group(['prefix' => 'admin2', 'as' => 'admin2.'], function () {
            
            Route::resource('home', HomeAdmin2Controller::class);
            //Surat Masuk
            Route::resource('suratmasukadmin2', SuratMasukAdmin2Controller::class);
        });

    });

    //role admin3
    Route::group([
        'middleware' => 'role.admin3'
    ], function () {

        Route::group(['prefix' => 'admin3', 'as' => 'admin3.'], function () {
            
            Route::resource('home', HomeAdmin3Controller::class);
            //Surat Masuk
            Route::resource('suratmasukadmin3', SuratMasukAdmin3Controller::class);
        });

    });

    //role user1
    Route::group([
        'middleware' => 'role.user1'
    ], function () {

        Route::group(['prefix' => 'user1', 'as' => 'user1.'], function () {
            
            Route::resource('dashboard', DashboardController::class);
        });

    });

    //role user2
    Route::group([
        'middleware' => 'role.user2'
    ], function () {

        Route::group(['prefix' => 'user2', 'as' => 'user2.'], function () {
            
            Route::resource('dashboard', DashboardController::class);
        });

    });

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/totalstok', [DashboardController::class, 'totalstok'])->name('/totalstok');
