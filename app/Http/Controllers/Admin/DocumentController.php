<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document;
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
            'field' => ['in:name,file,created_at'],
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
        return Inertia::render('Admin/Documents/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $name = $request->input('name');
        $tmp = $request->input('file');
        $arr = explode('/', $tmp);
        $uid = array_pop($arr);

        $path = 'files/' . Str::slug($name) . '-' . $uid;

        Storage::disk('public')->move($tmp, $path);

        $doc = new Document();
        $doc->name = $name;
        $doc->file = $path;
        $doc->save();

        return redirect()->route('admin:documents.index')->with('success', 'Dokumentum sikeresen létrehozva');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
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
            'document' => $document
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
        if(Storage::disk('public')->exists($document->file)) {

            $document->name = $name = $request->input('name');
            $path = 'files/' . Str::slug($name) . '-' . uniqid() . '.pdf';
            Storage::disk('public')->move($document->file, $path);

            $document->file = $path;
            $document->save();

            return redirect()->route('admin:documents.index')->with('success', 'Dokumentum sikeresen módosítva');
        }else {
            return redirect()->back()->withErrors(['file' => 'A dokumentum nem létezik']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if(Storage::disk('public')->exists($document->file)) {
            Storage::disk('public')->delete($document->file);
        }

        $document->delete();

        return redirect()->route('admin:documents.index')->with('success', 'Dokumentum sikeresen törölve');
    }
}
