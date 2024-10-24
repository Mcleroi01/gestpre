<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ClasseScolaireController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/eleves/create', [EleveController::class, 'create'])->name('eleves.create');
    Route::post('/eleves/create/action', [EleveController::class, 'store'])->name('eleves.store');
    Route::get('/classes/{classe}/cards', [EleveController::class, 'generateClassCards'])->name('eleves.generateClassCards');
    Route::get('/classe/{classe}/eleves', [ClasseScolaireController::class, 'showEleves'])->name('classe.eleves');
    Route::resource('cycles', CycleController::class);
    Route::resource('sections', SectionController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index');
Route::get('/presences/mark/{eleve_id}', [PresenceController::class, 'markPresence'])->name('presences.mark');
Route::post('/presences/store/{eleve_id}', [PresenceController::class, 'storePresence'])->name('presences.store');

require __DIR__ . '/auth.php';
