<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class DocumentController extends Controller
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
            'field' => ['in:name,type,date,created_at'],
        ]);

        $query = Document::query();

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }else {
            $query->latest();
        }

        return Inertia::render('Admin/Documents/Index', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'documents' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Documents/Create', [
            'types' => Document::TYPES
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $files = array();
        $name = $request->input('name');
        foreach($request->input('files') as $tmp) {
            $arr = explode('/', $tmp);
            $uid = array_pop($arr);
            $filename = Str::slug($name) . '-' . $uid;
            Storage::disk('public')->move($tmp, 'documents/' . $filename);
            $files[] = $filename;
        }

        $doc = new Document();
        $doc->fill($request->all('name', 'date', 'type', 'is_visible'));
        $doc->files = $files;
        $doc->save();

        return redirect()->route('admin:documents.index')->with('success', 'Dokumentum sikeresen létrehozva');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return Inertia::render('Admin/Documents/Edit', [
            'document' => $document,
            'types' => Document::TYPES
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, Document $document)
    {
        $files = array();
        $name = $request->input('name');

        if($name != $document->name) {
            foreach($request->input('files') as $tmp) {
                $arr = explode('.', $tmp);
                $ext = array_pop($arr);
                $path = 'files/' . Str::slug($name) . '-' . uniqid() . '.' . $ext;
                if(Storage::disk('public')->exists($tmp)) {
                    Storage::disk('public')->move($tmp, $path);
                    $files[] = $path;
                }else {
                    return redirect()->back()->with('error', 'A dokumentum nem található a szerveren');
                }
            }

            $document->files = $files;
        }

        $document->fill($request->all('name', 'date', 'type', 'is_visible'));
        $document->save();

        return redirect()->route('admin:documents.index')->with('success', 'Dokumentum sikeresen módosítva');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        foreach($document->files as $file) {
            if(Storage::disk('public')->exists('documents/' . $file)) {
                Storage::disk('public')->delete('documents/' . $file);
            }
        }

        $document->delete();

        return redirect()->route('admin:documents.index')->with('success', 'Dokumentum sikeresen törölve');
    }
}
