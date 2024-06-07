<?php

use App\Http\Controllers\CashflowController;
use App\Http\Controllers\ProfileController;
use App\Models\Cashflow;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware('auth')->group(function () {
    Route::resource('cashflows', CashflowController::class);
});

Route::get('/dashboard', function () {
    $cashflows = Cashflow::all()->makeHidden(['id', 'title', 'info']);
    return view('dashboard', ['cashflows' => $cashflows]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
