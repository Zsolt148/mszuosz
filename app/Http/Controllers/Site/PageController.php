<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Site/Home', [
            'content' => \App\Models\Page::query()->where('slug', 'home')->latest()->first()
        ]);
    }

    public function documents()
    {
        return Inertia::render('Site/Documents', [
            'documents' => \App\Models\Document::query()->visible()->get()->groupBy('type'),
            'types' => \App\Models\Document::TYPES,
        ]);
    }

    public function ranks()
    {
        return Inertia::render('Site/Page', [
            'content' => \App\Models\Page::query()->where('slug', 'ranks')->latest()->first()
        ]);
    }

    public function welcome()
    {
        return Inertia::render('Site/Page', [
            'content' => \App\Models\Page::query()->where('slug', 'welcome')->latest()->first()
        ]);
    }

    public function history()
    {
        return Inertia::render('Site/Page', [
            'content' => \App\Models\Page::query()->where('slug', 'history')->latest()->first()
        ]);
    }

    public function association()
    {
        return Inertia::render('Site/Page', [
            'content' => \App\Models\Page::query()->where('slug', 'association')->latest()->first()
        ]);
    }
}
