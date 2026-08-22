<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;

Route::get('/', \App\Livewire\Public\CekTagihan::class)->name('public.cek-tagihan');

Route::get('/login', Login::class)->name('login');
// Logout
Route::post('/logout', \App\Livewire\Auth\Logout::class . '@logout')->name('logout');

Route::get('/migrate-packages', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate');
    // Create initial packages if they don't exist
    if (\App\Models\Package::count() === 0) {
        \App\Models\Package::create(['name' => 'BASIC', 'max_customers' => 500, 'price' => 100000]);
        \App\Models\Package::create(['name' => 'STANDARD', 'max_customers' => 2000, 'price' => 250000]);
        \App\Models\Package::create(['name' => 'PROFESSIONAL', 'max_customers' => 5000, 'price' => 500000]);
        \App\Models\Package::create(['name' => 'ENTERPRISE', 'max_customers' => null, 'price' => 1000000]);
    }
    return \Illuminate\Support\Facades\Artisan::output() . ' Packages Seeded.';
});

Route::middleware(['auth'])->group(function () {


    // --------------------------------------------------------
    // LAYER 1: SUPER ADMIN (SaaS Manager)
    // --------------------------------------------------------
    Route::middleware('role:super_admin')->prefix('superadmin')->group(function () {
        Route::get('/dashboard', \App\Livewire\SuperAdmin\Dashboard::class)->name('superadmin.dashboard');
        Route::get('/tenant', \App\Livewire\SuperAdmin\Tenant\Index::class)->name('superadmin.tenant.index');
        Route::get('/package', \App\Livewire\SuperAdmin\Package\Index::class)->name('superadmin.package.index');
    });

    // --------------------------------------------------------
    // LAYER 2: TENANT ADMIN & STAF (Operasional)
    // --------------------------------------------------------
    Route::middleware('role:admin_tenant,bendahara,pengawas')->prefix('admin')->group(function () {
        Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
        Route::get('/pelanggan', \App\Livewire\Admin\Pelanggan\Index::class)->name('admin.pelanggan.index');
        Route::get('/pelanggan/{id}/kartu', [\App\Http\Controllers\CardController::class, 'cetak'])->name('admin.pelanggan.kartu');
        
        // Laporan Export
        Route::get('/keuangan/kas/export/excel', [\App\Http\Controllers\ReportController::class, 'exportKasExcel'])->name('admin.keuangan.kas.export.excel');
        Route::get('/keuangan/kas/export/pdf', [\App\Http\Controllers\ReportController::class, 'exportKasPdf'])->name('admin.keuangan.kas.export.pdf');

        Route::get('/tarif', \App\Livewire\Admin\Tarif\Index::class)->name('admin.tarif.index');
        Route::get('/meter/catat', \App\Livewire\Admin\Meter\Create::class)->name('admin.meter.create');
        Route::get('/penagihan', \App\Livewire\Admin\Penagihan\Index::class)->name('admin.penagihan.index');
        Route::get('/penagihan/{id}/eksekusi', \App\Livewire\Admin\Penagihan\Eksekusi::class)->name('admin.penagihan.eksekusi');
        Route::get('/penagihan/{pelangganId}/surat/{jenis}', [\App\Http\Controllers\PdfController::class, 'suratPenagihan'])->name('admin.penagihan.surat');
        Route::get('/keuangan/setoran', \App\Livewire\Admin\Keuangan\Setoran\Index::class)->name('admin.keuangan.setoran');
        Route::get('/keuangan/kas', \App\Livewire\Admin\Keuangan\Kas\Index::class)->name('admin.keuangan.kas.index');
        Route::get('/users', \App\Livewire\Admin\Users\Index::class)->name('admin.users.index')->middleware('role:admin_tenant');
        Route::get('/settings/tenant', \App\Livewire\Admin\Settings\TenantProfile::class)->name('admin.settings.tenant')->middleware('role:admin_tenant');
    });

    // Petugas (PWA Mobile) Routes
    Route::middleware('role:petugas')->prefix('pwa')->group(function () {
        Route::get('/dashboard', \App\Livewire\Pwa\Dashboard::class)->name('pwa.dashboard');
        Route::get('/meter/catat', \App\Livewire\Pwa\Meter\Create::class)->name('pwa.meter.create');
        Route::get('/pelanggan', \App\Livewire\Pwa\Pelanggan\Index::class)->name('pwa.pelanggan.index');
        Route::get('/kasir', \App\Livewire\Pwa\Kasir\Bayar::class)->name('pwa.kasir.bayar');
        Route::get('/setoran', \App\Livewire\Pwa\Setoran\Index::class)->name('pwa.setoran.index');
    });
});
