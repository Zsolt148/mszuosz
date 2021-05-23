<?php

// Admin routes
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Admin/Dashboard');
})->name('dashboard');

//users
Route::resource('users', UsersController::class)->only('index', 'edit', 'update', 'destroy');

//news
Route::resource('news', NewsController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//events
Route::resource('events', EventController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//locations
Route::resource('locations', LocationController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//teams
Route::resource('teams', TeamController::class)->only('index', 'create', 'store', 'edit', 'update');

//files
Route::resource('documents', DocumentController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//pages
Route::resource('pages', PageController::class)->only('index', 'edit', 'update');
