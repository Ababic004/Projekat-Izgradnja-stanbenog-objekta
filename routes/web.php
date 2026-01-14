<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\ProcurementRequestController;
use App\Http\Controllers\ProcurementController;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('auth')->group(function () {
    Route::resource('procurements', ProcurementController::class);
    // Dashboard
    Route::get('/dashboard', fn () => view('app.dashboard'))
        ->name('dashboard');

    // Public (ulogovan user) stranice
    Route::get('/nekretnine', [UnitController::class, 'publicIndex'])
        ->name('units.public');

    Route::get('/dokumentacija', [DocumentController::class, 'publicIndex'])
        ->name('documents.public');

    // USER – slanje zahteva za nabavku (samo create + store)
    Route::get('/nabavke/novo', [ProcurementRequestController::class, 'createPublic'])
        ->name('procurements.public.create');

    Route::post('/nabavke', [ProcurementRequestController::class, 'storePublic'])
        ->name('procurements.public.store');

    // ADMIN
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function () {
            Route::resource('projects', ProjectController::class);
            Route::resource('units', UnitController::class);
            Route::resource('documents', DocumentController::class);
            Route::resource('procurements', ProcurementRequestController::class);
        });
});

require __DIR__ . '/auth.php';



