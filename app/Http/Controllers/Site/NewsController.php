<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = News::query()
            ->with('tags')
            ->visible()
            ->orderByDesc('date');

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('tags', function ($tag) use ($search) {
                        $tag->where('name', 'LIKE', '%'.$search.'%');
                    });
        }

        return Inertia::render('Site/News/Index', [
            'filters' => request()->all(['search']),
            'news' => $query->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return Inertia::render('Site/News/Show', [
           'content' => $news->with('tags')->firstWhere('id', $news->id)
        ]);
    }
}
