<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array();

        $files = Storage::disk('public')->allFiles();
        $data['files'] = count($files);

        $data['visible_news'] = News::query()->visible()->count();
        $data['not_visible_news'] = News::query()->notVisible()->count();

        $data['visible_events'] = Event::query()->visible()->count();
        $data['not_visible_events'] = Event::query()->notVisible()->count();

        $data['visible_documents'] = Document::query()->visible()->count();
        $data['not_visible_documents'] = Document::query()->notVisible()->count();

        return Inertia::render('Admin/Dashboard', [
            'data' => $data,
        ]);
    }
}
