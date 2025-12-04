<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\BangunanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

// Arahkan root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// ===============================
// AUTH GUEST (hanya untuk tamu)
// ===============================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
});

// ===============================
// LOGOUT (harus login)
// ===============================
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ===============================
// DASHBOARD & CRUD (hanya login)
// ===============================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {

        $totalAssets = \App\Models\Barang::count();

        $totalTanah     = \App\Models\Tanah::count();
        $totalBangunan  = \App\Models\Bangunan::count();
        $totalRuangan   = \App\Models\Ruangan::count();
        $totalBarang    = $totalAssets;

        $maintenanceKeywords = ['maintenance', 'perbaikan', 'service', 'repair'];
        $brokenKeywords      = ['rusak', 'broken', 'damage', 'damaged'];

        $maintenanceAssets = 0;
        $brokenAssets = 0;

        foreach ($maintenanceKeywords as $kw) {
            $maintenanceAssets += \App\Models\Barang::whereRaw('LOWER(kondisi) like ?', ["%{$kw}%"])->count();
        }

        foreach ($brokenKeywords as $kw) {
            $brokenAssets += \App\Models\Barang::whereRaw('LOWER(kondisi) like ?', ["%{$kw}%"])->count();
        }

        if ($maintenanceAssets + $brokenAssets > $totalAssets) {
            $allIds = \App\Models\Barang::where(function ($q) use ($maintenanceKeywords, $brokenKeywords) {
                foreach (array_merge($maintenanceKeywords, $brokenKeywords) as $kw) {
                    $q->orWhereRaw('LOWER(kondisi) like ?', ["%{$kw}%"]);
                }
            })->pluck('id')->unique();

            $maintenanceAssets = \App\Models\Barang::whereIn('id', $allIds)
                ->where(function ($q) use ($maintenanceKeywords) {
                    foreach ($maintenanceKeywords as $kw) {
                        $q->orWhereRaw('LOWER(kondisi) like ?', ["%{$kw}%"]);
                    }
                })->count();

            $brokenAssets = \App\Models\Barang::whereIn('id', $allIds)
                ->where(function ($q) use ($brokenKeywords) {
                    foreach ($brokenKeywords as $kw) {
                        $q->orWhereRaw('LOWER(kondisi) like ?', ["%{$kw}%"]);
                    }
                })->count();
        }

        $activeAssets = max(0, $totalAssets - $maintenanceAssets - $brokenAssets);

        return view('dashboard', compact(
            'totalAssets', 'activeAssets', 'maintenanceAssets', 'brokenAssets',
            'totalTanah', 'totalBangunan', 'totalRuangan', 'totalBarang'
        ));
    })->name('dashboard');

    // TANAH
    Route::get('/tanah', [TanahController::class, 'index'])->name('tanah.index');
    Route::get('/tanah/create', [TanahController::class, 'create'])->name('tanah.create');
    Route::post('/tanah', [TanahController::class, 'store'])->name('tanah.store');
    Route::get('/tanah/{id}/edit', [TanahController::class, 'edit'])->name('tanah.edit');
    Route::put('/tanah/{id}', [TanahController::class, 'update'])->name('tanah.update');
    Route::delete('/tanah/{id}', [TanahController::class, 'destroy'])->name('tanah.destroy');

    // BANGUNAN
    Route::get('/bangunan', [BangunanController::class, 'index'])->name('bangunan.index');
    Route::get('/bangunan/create', [BangunanController::class, 'create'])->name('bangunan.create');
    Route::post('/bangunan', [BangunanController::class, 'store'])->name('bangunan.store');
    Route::get('/bangunan/{id}/edit', [BangunanController::class, 'edit'])->name('bangunan.edit');
    Route::put('/bangunan/{id}', [BangunanController::class, 'update'])->name('bangunan.update');
    Route::delete('/bangunan/{id}', [BangunanController::class, 'destroy'])->name('bangunan.destroy');

    // RUANGAN
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    // BARANG
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // KATEGORI
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // USER MANAGEMENT (admin only)
    Route::get('/users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [\App\Http\Controllers\UsersController::class, 'destroy'])->name('users.destroy');
});