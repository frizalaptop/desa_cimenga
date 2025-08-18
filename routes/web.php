<?php

use App\Http\Controllers\LetterController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('residents', ResidentController::class)
    ->middleware(['auth', 'verified'])
    ->names('residents');

Route::get('apply/{letter}', [LetterController::class, 'apply'])
    ->middleware(['auth', 'verified'])
    ->name('letters.apply');     

Route::resource('letters', LetterController::class)
    ->middleware(['auth', 'verified'])
    ->names('letters');

Route::resource('petitions', PetitionController::class)
    ->middleware(['auth', 'verified'])
    ->names('petitions');

require __DIR__.'/auth.php';
