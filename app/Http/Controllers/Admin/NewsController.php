<?php

namespace App\Http\Controllers\Admin;

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
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,slug,created_at'],
        ]);

        $query = News::query();

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('slug', 'LIKE', '%'.$search.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }else {
            $query->latest();
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
        return Inertia::render('Admin/News/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
           'name' => ['required'],
           'slug' => ['required'],
           'body' => ['required'],
        ]);

        $news = new News();
        $news->user()->associate(Auth::user());
        $news->name = $request->input('name');
        $news->slug = Str::slug($request->input('slug'));
        $news->body = $request->input('body');
        $news->save();

        return redirect()->route('admin:news.index')->with('success', 'Hír sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
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
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        request()->validate([
            'name' => ['required'],
            'slug' => ['required'],
            'body' => ['required'],
        ]);

        $news->name = $request->input('name');
        $news->slug = Str::slug($request->input('slug'));
        $news->body = $request->input('body');
        $news->save();

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
        $news->delete();

        return redirect()->route('admin:news.index')->with('success', 'Hír sikeresn törölve');
    }
}
