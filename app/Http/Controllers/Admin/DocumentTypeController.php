<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentTypeRequest;
use App\Models\DocumentType;
use Inertia\Inertia;

class DocumentTypeController extends Controller
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
            'field' => ['in:name,date,created_at'],
        ]);

        $query = DocumentType::query();

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }else {
            $query->latest();
        }

        return Inertia::render('Admin/DocumentTypes/Index', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'documentTypes' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/DocumentTypes/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypeRequest $request)
    {
        $doc = new DocumentType();
        $doc->fill($request->all('name', 'is_visible'));
        $doc->save();

        return redirect()->route('admin:documentTypes.index')->with('success', 'Dokumentum típus sikeresen létrehozva');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        return Inertia::render('Admin/DocumentTypes/Edit', [
            'documentType' => $documentType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentTypeRequest $request, DocumentType $documentType)
    {
        $documentType->update($request->all('name', 'is_visible'));

        return redirect()->route('admin:documentTypes.index')->with('success', 'Dokumentum típus sikeresen módosítva');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();

        return redirect()->route('admin:documentTypes.index')->with('success', 'Dokumentum típus sikeresen törölve');
    }
}
