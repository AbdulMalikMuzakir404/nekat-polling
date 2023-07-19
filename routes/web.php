<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Siswa\VoteController;
use App\Http\Controllers\Siswa\SiswaHomeController;
use App\Http\Controllers\Admin\DetailOsisController;
use App\Http\Controllers\Admin\CrudDataOsisController;
use App\Http\Controllers\Admin\CrudDataSiswaController;
use App\Http\Controllers\Excel\ExportDataOsisController;
use App\Http\Controllers\Admin\CrudDataPanitiaController;
use App\Http\Controllers\Excel\ExportDataSiswaController;
use App\Http\Controllers\Excel\ExportDataPanitiaController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome')->middleware('guest');

Auth::routes();

Route::group(['prefix' => 'siswa', 'middleware' => ['auth', 'siswa']], function () {
    Route::get('/home', [SiswaHomeController::class, 'index'])->name('siswa.home');

    // Read Details Calon OSIS
    Route::get('/detail-osis/{id}', [DetailOsisController::class, 'index'])->name('detail-osis');

    // Fungsi Vote
    Route::post('/vote/{id}', [VoteController::class, 'vote'])->name('vote.siswa');

    // Success
    Route::get('/success', [SiswaHomeController::class, 'success'])->name('siswa.success');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'panitia']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

    // CRUD data siswa
    Route::resource('/data-siswa', CrudDataSiswaController::class)->middleware('admin');
    Route::post('/data-siswa/update', [CrudDataSiswaController::class, 'ubah'])->name('data-siswa.ubah')->middleware('admin');

    // CRUD data panitia
    Route::resource('/data-panitia', CrudDataPanitiaController::class)->middleware('admin');
    Route::post('/data-panitia/update', [CrudDataPanitiaController::class, 'ubah'])->name('data-panitia.ubah')->middleware('admin');

    // CRUD data OSIS
    Route::resource('/data-osis', CrudDataOsisController::class);
    Route::post('/data-osis/update', [CrudDataOsisController::class, 'ubah'])->name('data-osis.ubah');
    Route::post('/data-osis/image', [CrudDataOsisController::class, 'storeImage'])->name('data-osis.storeImage');
    Route::get('/data-osis/get-calon-osis/{nis}', [CrudDataOsisController::class, 'getCalonOsis'])->name('data-osis.getCalonOsis');
    Route::get('/data-osis/get-wakil-calon-osis/{nis}', [CrudDataOsisController::class, 'getWakilCalonOsis'])->name('data-osis.getWakilCalonOsis');

    // Export dan Import Data Siswa
    Route::get('/export-data-siswa', [ExportDataSiswaController::class, 'exportDataSiswa'])->name('export.data.siswa');
    Route::post('/import-data-siswa', [ExportDataSiswaController::class, 'importDataSiswa'])->name('import.data.siswa');

    // Export dan Import Data Panitia
    Route::get('/export-data-panitia', [ExportDataPanitiaController::class, 'exportDataPanitia'])->name('export.data.panitia');
    Route::post('/import-data-panitia', [ExportDataPanitiaController::class, 'importDataPanitia'])->name('import.data.panitia');

    // Export dan Import Data OSIS
    Route::get('/export-data-osis', [ExportDataOsisController::class, 'exportDataOsis'])->name('export.data.osis');
    Route::post('/import-data-osis', [ExportDataOsisController::class, 'importDataOsis'])->name('import.data.osis');
});
