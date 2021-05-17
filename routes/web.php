<?php

use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Site/Home', [
        'content' => \App\Models\Page::query()->where('slug', 'home')->latest()->first()
    ]);
})->name('home');

Route::get('/news', [\App\Http\Controllers\Site\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [\App\Http\Controllers\Site\NewsController::class, 'show'])->name('news.show');

Route::get('/events', function () {
    return Inertia::render('Site/');
})->name('events');

Route::get('/documents', function () {
    return Inertia::render('Site/');
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
Route::middleware(['auth:sanctum', 'verified'])
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
    Route::get('events', [UsersController::class, 'index'])->name('events.index');

    //teams
    Route::resource('teams', TeamController::class)->only('index', 'create', 'store', 'edit', 'update');

    //pages
    Route::resource('pages', PageController::class)->only('index', 'edit', 'update');

});
