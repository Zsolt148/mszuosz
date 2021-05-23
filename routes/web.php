<?php

use App\Http\Controllers\Site\PageController as SitePageController;
use App\Http\Controllers\UploadController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//pages
Route::get('/', [SitePageController::class, 'home'])->name('home');
Route::get('/documents', [SitePageController::class, 'documents'])->name('documents');
Route::get('/ranks', [SitePageController::class, 'ranks'])->name('ranks');
Route::get('/welcome', [SitePageController::class, 'welcome'])->name('welcome');
Route::get('/history', [SitePageController::class, 'history'])->name('history');
Route::get('/association', [SitePageController::class, 'association'])->name('association');

Route::get('/news', [\App\Http\Controllers\Site\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [\App\Http\Controllers\Site\NewsController::class, 'show'])->name('news.show');

Route::get('/events', [\App\Http\Controllers\Site\EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [\App\Http\Controllers\Site\EventController::class, 'show'])->name('events.show');
Route::get('/teams', [\App\Http\Controllers\Site\TeamController::class, 'index'])->name('teams');

//Filepond
Route::post('process', [UploadController::class, 'store']);
Route::delete('revert', [UploadController::class, 'destroy']);

//File views
Route::get('/files/{filename}', function ($filename = '') {
    $path = storage_path('app/public/files/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//jetstream routes
Route::prefix('')->group(base_path('routes/jetstream.php'));

//admin
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin:')
    ->group(base_path('routes/admin.php'));
