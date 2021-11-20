<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Site/Home', [
            'content' => Page::query()->where('slug', 'home')->latest()->first()
        ]);
    }

    public function documents()
    {
        return Inertia::render('Site/Documents', [
            'documents' => Document::query()
                ->visible()
                ->orderBy('date', 'desc')
                ->get()
                ->groupBy('document_type_id'),
            'types' => DocumentType::query()
                ->visible()
                ->orderBy('name')
                ->get()
        ]);
    }

    public function ranks()
    {
        return Inertia::render('Site/Page', [
            'content' => Page::query()->where('slug', 'ranks')->latest()->first()
        ]);
    }

    public function welcome()
    {
        return Inertia::render('Site/Page', [
            'content' => Page::query()->where('slug', 'welcome')->latest()->first()
        ]);
    }

    public function history()
    {
        return Inertia::render('Site/Page', [
            'content' => Page::query()->where('slug', 'history')->latest()->first()
        ]);
    }

    public function association()
    {
        return Inertia::render('Site/Page', [
            'content' => Page::query()->where('slug', 'association')->latest()->first()
        ]);
    }

    public function policy()
    {
        return Inertia::render('Site/Page', [
            'content' => Page::query()->where('slug', 'policy')->latest()->first()
        ]);
    }

    public function impresszum()
    {
        return Inertia::render('Site/Page', [
            'content' => Page::query()->where('slug', 'impresszum')->latest()->first()
        ]);
    }

    public function contact()
    {
        return Inertia::render('Site/Page', [
            'content' => Page::query()->where('slug', 'contact')->latest()->first()
        ]);
    }
}
