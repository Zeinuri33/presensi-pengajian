<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\Arsip\SuratkeluarController;
use App\Http\Controllers\Arsip\SuratmasukController;
use App\Http\Controllers\AsramaController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KepalaKamarController;
use App\Http\Controllers\KhidmahController;
use App\Http\Controllers\LiburController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembinaanController;
use App\Http\Controllers\Postel\TransaksiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;
use App\Models\Pembinaan;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Illuminate\Support\Facades\Artisan;




// Halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/ngaji', [AbsenController::class, 'absen']);


// Halaman dashboard (hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/', [AbsenController::class, 'beranda']);
});

//Absen
Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');

//Presensi
Route::middleware(['auth', PermissionMiddleware::class . ':absen-lihat'])->group(function () {
    Route::get('/presensi-kepalakamar', [AbsenController::class, 'kepala'])->name('absen.kepala');
    Route::get('/presensi-wakilkamar', [AbsenController::class, 'wakil'])->name('absen.wakil');
});
Route::middleware(['auth', PermissionMiddleware::class . ':absen-tambah'])->group(function () {
    Route::post('/presensi/susulan', [AbsenController::class, 'susulan'])->name('absen.susulan');
});
Route::middleware(['auth', PermissionMiddleware::class . ':absen-hapus'])->group(function () {
    Route::get('/presensi/{id}', [AbsenController::class, 'hapus'])->name('absen.hapus');
});
Route::middleware(['auth', PermissionMiddleware::class . ':absen-tidak hadir'])->group(function () {
    Route::get('/presensi-tidakhadir', [AbsenController::class, 'tidakHadir'])->name('laporan.tidak-hadir');
    Route::post('/presensi/pembinaan/{id}', [AbsenController::class, 'tandaiPembinaan'])->name('absensi.tandai_pembinaan');
});

Route::middleware(['auth', PermissionMiddleware::class . ':absen-pembinaan'])->group(function () {
    Route::get('/presensi-pembinaan', [AbsenController::class, 'pembinaan'])->name('absen.pembinaan');
    Route::get('/presensi-pembinaan/{id}/hapus', [AbsenController::class, 'hapuspembinaan'])->name('hapus.pembinaan');
});
Route::middleware(['auth', PermissionMiddleware::class . ':absen-ket'])->group(function () {
    Route::get('/presensi-ket', [AbsenController::class, 'ket'])->name('absen.ket');
    Route::get('/presensi-ket/cetak', [AbsenController::class, 'cetakAktif'])->name('absensi.ket.cetak');
    // Cetak per kepala kamar
    Route::get('/ket/cetak/{id}', [AbsenController::class, 'cetakAktifPerKk'])->name('absensi.ket.cetak.perkk');

});

Route::get('/kehadiran', [AbsenController::class, 'rekapKehadiran'])->name('rekap.kehadiran');
Route::get('/ketidakhadiran', [AbsenController::class, 'rekapKetidakhadiran'])->name('rekap.ketidakhadiran');
Route::get('/panggilan/{id}/perhari', [AbsenController::class, 'suratPanggilanPerHari'])->name('panggilan.perhari');



//Izin
Route::middleware(['auth', PermissionMiddleware::class . ':izin-lihat'])->group(function () {
    Route::resource('/izin', IzinController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':izin-hapus'])->group(function () {
    Route::get('/izin/{id}/hapus', [IzinController::class, 'hapus']);
});

//Libur
Route::middleware(['auth', PermissionMiddleware::class . ':libur-lihat'])->group(function () {
    Route::resource('/libur', LiburController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':libur-hapus'])->group(function () {
    Route::get('/libur/{id}/hapus', [LiburController::class, 'hapus']);
});



//Pengguna
Route::middleware(['auth', PermissionMiddleware::class . ':pengguna-lihat'])->group(function () {
    Route::resource('/pengguna', UserController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':pengguna-hapus'])->group(function () {
    Route::get('/pengguna/{id}/hapus', [UserController::class, 'destroy']);
});

//Hak Akses
Route::middleware(['auth', PermissionMiddleware::class . ':hak akses-lihat'])->group(function () {
    Route::resource('/hakakses', RoleController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':hak akses-tambah'])->group(function () {
    Route::resource('/akses', PermissionController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':hak akses-edit'])->group(function () {
    Route::get('/hakakses/{id}/edit', [RoleController::class, 'edit']);
    Route::put('/hakakses={role}', [RoleController::class, 'perbarui'])->name('roles.update');
});

//Asrama
Route::middleware(['auth', PermissionMiddleware::class . ':asrama-lihat'])->group(function () {
    Route::resource('/asrama' , AsramaController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':asrama-hapus'])->group(function () {
    Route::get('/asrama/{id}/hapus', [AsramaController::class, 'hapus']);
});

//Kepala Kamar
Route::middleware(['auth', PermissionMiddleware::class . ':kepala kamar-lihat'])->group(function () {
    Route::resource('/kepalakamar', KepalaKamarController::class);
    Route::get('/kepalakamar-cetak', [KepalaKamarController::class, 'cetakKA'])->name('kepalakamar.cetak');
});
Route::middleware(['auth', PermissionMiddleware::class . ':kepala kamar-edit'])->group(function () {
    Route::get('/kepalawakilkamar={id}', [KepalaKamarController::class, 'edit']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':kepala kamar-detail'])->group(function () {
    Route::get('/kepalawakilkamar-kehadiran={id}', [AbsenController::class, 'detail']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':kepala kamar-verifikasi'])->group(function () {
    Route::get('/kepalawakilkamar-verifikasi', [KepalaKamarController::class, 'verifikasi'])->name('postel.verifikasi');
    Route::post('/kepalawakilkamar-verifikasi', [KepalaKamarController::class, 'verifikasiCari'])->name('postel.verifikasi.cari');

});
Route::middleware(['auth', PermissionMiddleware::class . ':kepala kamar-hapus'])->group(function () {
    Route::get('/kepalakamar/{id}/hapus', [KepalaKamarController::class, 'hapus']);
});

//Wakil Kamar
Route::middleware(['auth', PermissionMiddleware::class . ':wakil kamar-lihat'])->group(function () {
    Route::get('/wakilkamar', [KepalaKamarController::class, 'wakil']);
    Route::get('/wakilkamar-cetak', [KepalaKamarController::class, 'cetakWK'])->name('wakilkamar.cetak');
});
Route::middleware(['auth', PermissionMiddleware::class . ':wakil kamar-hapus'])->group(function () {
    Route::get('/wakilkamar/{id}/hapus', [KepalaKamarController::class, 'hapus']);
    
});


//Kegiatan
Route::middleware(['auth', PermissionMiddleware::class . ':kegiatan-lihat'])->group(function () {
    Route::resource('/kegiatan', KegiatanController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':kegiatan-detail'])->group(function () {
    Route::get('/kegiatan/{id}/detail', [KegiatanController::class, 'detail'])->name('kegiatan.detail');
});
Route::middleware(['auth', PermissionMiddleware::class . ':kegiatan-hapus'])->group(function () {
    Route::get('/kegiatan/{id}/hapus', [KegiatanController::class, 'hapus']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':kegiatan-cetak'])->group(function () {
    Route::get('/kegiatan/{id}/cetak', [KegiatanController::class, 'cetak'])->name('kegiatan.cetak');
});

Route::get('/kegiatan/{id}/presensi', [PresensiController::class, 'form'])->name('presensi.form');
Route::post('/kegiatan/{id}/presensi', [PresensiController::class, 'submit'])->name('presensi.submit');


//Semester
Route::middleware(['auth', PermissionMiddleware::class . ':semester-lihat'])->group(function () {
    Route::resource('/semester', SemesterController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':semester-hapus'])->group(function () {
    Route::get('/semester/{id}/hapus', [SemesterController::class, 'hapus']);
});


//Surat Masuk
Route::middleware(['auth', PermissionMiddleware::class . ':surat masuk-lihat'])->group(function () {
    Route::resource('/suratmasuk', SuratmasukController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':surat masuk-hapus'])->group(function () {
    Route::get('/suratmasuk/{id}/hapus', [SuratmasukController::class, 'hapus']);
});

//Surat Keluar
Route::middleware(['auth', PermissionMiddleware::class . ':surat keluar-lihat'])->group(function () {
    Route::resource('/suratkeluar', SuratkeluarController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':surat keluar-hapus'])->group(function () {
    Route::get('/suratkeluar/{id}/hapus', [SuratkeluarController::class, 'hapus']);
});

//Khidmah
Route::middleware(['auth', PermissionMiddleware::class . ':khidmah-lihat'])->group(function () {
    Route::get('/khidmah', [KhidmahController::class, 'jadwal']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':khidmah-cetak'])->group(function () {
    Route::get('/khidmah/jadwal/cetak', [KhidmahController::class, 'cetakJadwal'])->name('jadwal.cetak');
});
Route::middleware(['auth', PermissionMiddleware::class . ':khidmah-absen'])->group(function () {
    Route::get('/khidmah/presensi/cetak', [KhidmahController::class, 'cetakPresensi'])->name('presensi.cetak');
});

//Postel
Route::middleware(['auth', PermissionMiddleware::class . ':transaksi postel-lihat'])->group(function () {
    Route::resource('/postel-transaksi', TransaksiController::class);
});

Route::middleware(['auth', PermissionMiddleware::class . ':transaksi postel-hapus'])->group(function () {
    Route::get('/postel-transaksi/{id}/hapus', [TransaksiController::class, 'hapus']);
});


Route::get('/artisan-clear', function () {
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    return "View, Config, and Cache cleared!";
});



