<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,type,is_visible,date,created_at'],
        ]);

        $query = News::query();

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('slug', 'LIKE', '%'.$search.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }else {
            $query->orderByDesc('date');
        }

        return Inertia::render('Admin/News/Index', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'news' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/News/Create', [
            'types' => News::TYPES,
            'files' => Storage::disk('public')->files('documents'),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = new News();
        $news->fill($request->except('tags'));
        $news->user()->associate(Auth::user());
        $news->slug = Str::slug($request->input('slug'));
        $news->save();

        $tagIds = collect();
        foreach($request->input('tags') as $tag) {
            $id = Tag::firstOrCreate([
                'name' => $tag['name']
            ])->id;
            $tagIds->push($id);
        }

        $news->tags()->attach($tagIds);

        return redirect()->route('admin:news.index')->with('success', 'Hír sikeresen létrehozva');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return Inertia::render('Admin/News/Edit', [
            'news' => $news,
            'types' => News::TYPES,
            'files' => Storage::disk('public')->files('documents'),
            'tags' => Tag::all(),
            'selectedTags' => $news->tags()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $news->fill($request->except('tags'));
        $news->slug = Str::slug($request->input('slug'));
        $news->save();

        $tagIds = collect();
        foreach($request->input('tags') as $tag) {
            $id = Tag::firstOrCreate([
                'name' => $tag['name']
            ])->id;
            $tagIds->push($id);
        }

        $news->tags()->sync($tagIds);

        return redirect()->back()->with('success', 'Hír sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->tags()->detach();

        $news->delete();

        return redirect()->route('admin:news.index')->with('success', 'Hír sikeresn törölve');
    }
}
