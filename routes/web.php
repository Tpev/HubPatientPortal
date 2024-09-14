<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\FormInstanceController;

// Admin routes
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/forms/create', [FormTemplateController::class, 'create'])->name('forms.create');
    Route::post('/admin/forms', [FormTemplateController::class, 'store'])->name('forms.store');
    Route::post('/forms/{form}/instances', [FormInstanceController::class, 'store'])->name('formInstances.store');
    // Route to view all form templates
    Route::get('/admin/forms', [FormTemplateController::class, 'index'])->name('forms.index');
    
    // Route to create form instances for a specific template
    Route::post('/admin/forms/{form}/instances', [FormInstanceController::class, 'store'])->name('formInstances.store');
    



});



// Patient routes
// Route to display the form instance to the patient or user
Route::get('/form/{uuid}', [FormInstanceController::class, 'show'])->name('formInstances.show');
Route::post('/form/{uuid}', [FormInstanceController::class, 'submit'])->name('formInstances.submit');



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
