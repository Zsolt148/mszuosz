<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationController extends Controller
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
            'field' => ['in:name,country,city,address,created_at'],
        ]);

        $query = Location::query();

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('city', 'LIKE', '%'.$search.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }else {
            $query->latest();
        }

        return Inertia::render('Admin/Locations/Index', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'locations' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Locations/Create', ['countries' => config('countries.eu')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $loc = new Location();
        $loc->fill($request->all());
        $loc->save();

        return redirect()->route('admin:locations.index')->with('success', 'Helyszín sikeresn létrehozva');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return Inertia::render('Admin/Locations/Edit', [
            'location' => $location,
            'countries' => config('countries.eu'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        $location->update($request->all());

        return redirect()->route('admin:locations.index')->with('success', 'Helyszín sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if($location->events()->exists()) {
            return back()->with('error', 'A helyszín nem törölhető mert van hozzárendelt verseny!');
        }

        $location->delete();

        return redirect()->route('admin:locations.index')->with('success', 'Helyszín sikeresen törölve');
    }
}
