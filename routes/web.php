<?php

use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\UploadController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Site/Home', [
        'content' => \App\Models\Page::query()->where('slug', 'home')->latest()->first()
    ]);
})->name('home');

Route::get('/news', [\App\Http\Controllers\Site\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [\App\Http\Controllers\Site\NewsController::class, 'show'])->name('news.show');

Route::get('/events', [\App\Http\Controllers\Site\EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [\App\Http\Controllers\Site\EventController::class, 'show'])->name('events.show');

Route::get('/documents', function () {
    return Inertia::render('Site/Documents', [
        'documents' => \App\Models\Document::all()
    ]);
})->name('documents');

Route::get('/teams', [\App\Http\Controllers\Site\TeamController::class, 'index'])->name('teams');

Route::get('/ranks', function () {
    return Inertia::render('Site/Page', [
        'content' => \App\Models\Page::query()->where('slug', 'ranks')->latest()->first()
    ]);
})->name('ranks');

//dropdown - association
Route::get('/welcome', function () {
    return Inertia::render('Site/Page', [
        'content' => \App\Models\Page::query()->where('slug', 'welcome')->latest()->first()
    ]);
})->name('welcome');

Route::get('/history', function () {
    return Inertia::render('Site/Page', [
        'content' => \App\Models\Page::query()->where('slug', 'history')->latest()->first()
    ]);
})->name('history');

Route::get('/association', function () {
    return Inertia::render('Site/Page', [
        'content' => \App\Models\Page::query()->where('slug', 'association')->latest()->first()
    ]);
})->name('association');

//admin
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin:')
    ->group(function () {

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

});

//Filepond
Route::post('process', [UploadController::class, 'store']);
Route::delete('revert', [UploadController::class, 'destroy']);

//jetstream routes
require_once __DIR__ . '/jetstream.php';
