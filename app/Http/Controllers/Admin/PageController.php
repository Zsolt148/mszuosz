<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
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
            'field' => ['in:name,slug,body'],
        ]);

        $query = Page::query();

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Admin/Pages/Index', [
            'filters' => \request()->all(['search', 'field', 'direction']),
            'pages' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return Inertia::render('Admin/Pages/Edit', [
           'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'name' => ['required'],
            'body' => ['required'],
        ]);

        $page->update($request->all(['name', 'body']));

        return redirect()->back()->with('success', 'Oldal sikeresen frissítve');
    }

}
