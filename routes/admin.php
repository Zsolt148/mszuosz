<?php

// Admin routes
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//users
Route::resource('users', UsersController::class)->only('index', 'edit', 'update', 'destroy');

//news
Route::resource('news', NewsController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//events
Route::delete('events/{event}/deleteFile/field/{field}/filename/{file}', [EventController::class, 'deleteFile'])->name('events.delete.file');
Route::resource('events', EventController::class);

//locations
Route::resource('locations', LocationController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//teams
Route::get('teams/import', [TeamController::class, 'import'])->name('teams.import');
Route::post('teams/upload', [TeamController::class, 'upload'])->name('teams.upload');
Route::resource('teams', TeamController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//files
Route::resource('documents', DocumentController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//pages
Route::resource('pages', PageController::class)->only('index', 'edit', 'update');
