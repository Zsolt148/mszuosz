<?php

// Admin routes
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Admin/Dashboard');
})->name('dashboard');

//users
Route::get('users', [UsersController::class, 'index'])->name('users');
Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('users/{user}/update', [UsersController::class, 'update'])->name('users.update');
Route::delete('users/{user}/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
