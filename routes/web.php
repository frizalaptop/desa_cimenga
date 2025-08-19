<?php

use App\Http\Controllers\LetterController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('letters/{letter}/apply', [LetterController::class, 'apply'])
    ->middleware(['auth', 'verified'])
    ->name('letters.apply');     

Route::resource('letters', LetterController::class)
    ->middleware(['auth', 'verified'])
    ->names('letters');

Route::get('petitions/statistic', [PetitionController::class, 'statistic'])
    ->middleware(['auth', 'verified'])
    ->name('petitions.statistic'); 

Route::put('petitions/{petition}/approve', [PetitionController::class, 'approve'])
    ->middleware(['auth', 'verified'])
    ->name('petitions.approve'); 

Route::put('petitions/{petition}/reject', [PetitionController::class, 'reject'])
    ->middleware(['auth', 'verified'])
    ->name('petitions.reject'); 

Route::put('petitions/{petition}/complete', [PetitionController::class, 'complete'])
    ->middleware(['auth', 'verified'])
    ->name('petitions.complete'); 

Route::delete('petitions/reset', [PetitionController::class, 'reset'])
    ->middleware(['auth', 'verified'])
    ->name('petitions.reset'); 

Route::resource('petitions', PetitionController::class)
    ->middleware(['auth', 'verified'])
    ->names('petitions');

Route::controller( UserController::class)->group(function () {
    Route::get('users', 'index')
        ->name('users.index');
    Route::put('users/{user}/promote', 'promote')
        ->name('users.promote');
    Route::put('users/{user}/demote', 'demote')
        ->name('users.demote');
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
