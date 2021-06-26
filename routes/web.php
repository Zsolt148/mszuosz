<?php

use App\Http\Controllers\Site\PageController as SitePageController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//pages
Route::get('/', [SitePageController::class, 'home'])->name('home');
Route::get('/dokumentumok', [SitePageController::class, 'documents'])->name('documents');
Route::get('/ranglistak', [SitePageController::class, 'ranks'])->name('ranks');
Route::get('/bemutatkozas', [SitePageController::class, 'welcome'])->name('welcome');
Route::get('/tortenet', [SitePageController::class, 'history'])->name('history');
Route::get('/szervezeti-mukodes', [SitePageController::class, 'association'])->name('association');
Route::get('/impresszum', [SitePageController::class, 'impresszum'])->name('impresszum');
Route::get('/adatvedelmi-iranyelvek', [SitePageController::class, 'policy'])->name('policy');
Route::get('/kapcsolat', [SitePageController::class, 'contact'])->name('contact');

Route::get('/hirek', [\App\Http\Controllers\Site\NewsController::class, 'index'])->name('news.index');
Route::get('/hirek/{news:slug}', [\App\Http\Controllers\Site\NewsController::class, 'show'])->name('news.show');

Route::get('/versenyek', [\App\Http\Controllers\Site\EventController::class, 'index'])->name('events.index');
Route::get('/versenyek/{event:slug}', [\App\Http\Controllers\Site\EventController::class, 'show'])->name('events.show');
Route::get('/egyesuletek', [\App\Http\Controllers\Site\TeamController::class, 'index'])->name('teams.index');
Route::get('/egyesuletek/{team}', [\App\Http\Controllers\Site\TeamController::class, 'show'])->name('teams.show');

//Filepond
Route::post('process/{name}', [UploadController::class, 'store']);
Route::delete('revert', [UploadController::class, 'destroy']);

//File views
Route::get('/documents/{name}', function ($name = '') {
    $file = storage_path('app/public/documents/' . $name);
    if (!File::exists($file)) abort(404);
    return response()->file($file);
});

Route::get('/events/{event}/{name}', function ($event = '', $name = '') {
    $file = storage_path('app/public/events/' . $event . '/' . $name);
    if (!File::exists($file)) abort(404);
    return response()->file($file);
});

//jetstream routes
Route::prefix('')->group(base_path('routes/jetstream.php'));

//admin
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin:')
    ->group(base_path('routes/admin.php'));
