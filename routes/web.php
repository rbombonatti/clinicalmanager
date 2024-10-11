<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HealthInsurancePlanController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\ProcedurePriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialtyController;
use App\Models\Consultation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('doctors', DoctorController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('procedures', ProcedureController::class);
    Route::resource('healthinsuranceplans', HealthInsurancePlanController::class);
    Route::resource('pricelists', PriceListController::class);
    Route::resource('procedureprices', ProcedurePriceController::class);
    Route::resource('consultations', ConsultationController::class);

    Route::get('generateProcedurePricesAtNewHealthInsurancePlan/{healthinsuranceplan}',
        [ProcedurePriceController::class, 'generateProcedurePricesAtNewHealthInsurancePlan'])
        ->name('generateProcedurePricesAtNewHealthInsurancePlan');
});

require __DIR__.'/auth.php';
