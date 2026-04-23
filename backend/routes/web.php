<?php

use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'presentation'])->name('presentation');
Route::get('/portfolio', [PortfolioController::class, 'sphere'])->name('portfolio');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth.basic')->group(function (): void {
    Route::get('/admin/projects', [AdminProjectController::class, 'index'])->name('admin.projects');
    Route::get('/admin/messages', [AdminProjectController::class, 'contacts'])->name('admin.messages');
    Route::post('/admin/projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');
    Route::put('/admin/projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/admin/projects/{project}', [AdminProjectController::class, 'destroy'])->name('admin.projects.destroy');
});
