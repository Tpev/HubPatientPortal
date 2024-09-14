<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Middleware\IsAdmin;





Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin/forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::post('/admin/forms', [FormController::class, 'store'])->name('forms.store');
    Route::get('/admin/forms/{form}/submissions', [FormController::class, 'submissions'])->name('forms.submissions');
});

Route::get('/forms/{form}', [FormController::class, 'show'])->name('forms.show');
Route::post('/forms/{form}', [FormController::class, 'submit'])->name('forms.submit');





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

require __DIR__.'/auth.php';
