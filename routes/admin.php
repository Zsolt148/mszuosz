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
use App\Http\Controllers\Admin\DocumentTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//locations
Route::resource('locations', LocationController::class)
    ->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//news
Route::resource('news', NewsController::class)
    ->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//events
Route::delete('events/{event}/deleteFile/field/{field}/filename/{file}', [EventController::class, 'deleteFile'])
    ->name('events.delete.file');

Route::resource('events', EventController::class);

//files
Route::resource('documents', DocumentController::class)
    ->only('index', 'create', 'store', 'edit', 'update', 'destroy');

//files
Route::resource('documentTypes', DocumentTypeController::class)
    ->only('index', 'create', 'store', 'edit', 'update', 'destroy');

// Admin only
Route::middleware('role:admin')
    ->group(function () {
        //users
        Route::resource('users', UsersController::class)
            ->only('index', 'edit', 'update', 'destroy');

        //teams
        Route::get('teams/import', [TeamController::class, 'import'])
            ->name('teams.import');

        Route::post('teams/upload', [TeamController::class, 'upload'])
            ->name('teams.upload');

        Route::get('teams/{team}/edit', [TeamController::class, 'edit'])->withTrashed()->name('teams.edit');
        Route::put('teams/{team}/update', [TeamController::class, 'update'])->withTrashed()->name('teams.update');
        Route::post('teams/{team}/restore', [TeamController::class, 'restore'])->withTrashed()->name('teams.restore');
        Route::delete('teams/{team}/force-delete', [TeamController::class, 'forceDelete'])->withTrashed()->name('teams.force-delete');
        Route::resource('teams', TeamController::class)
            ->only('index', 'create', 'store', 'destroy');

        //pages
        Route::resource('pages', PageController::class)
            ->only('index', 'edit', 'update');
    });
