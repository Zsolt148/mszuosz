<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,country,city,address,created_at'],
        ]);

        $query = Location::query();

        if ($search = request('search')) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('city', 'LIKE', '%' . $search . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        } else {
            $query->latest();
        }

        return Inertia::render('Admin/Locations/Index', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'locations' => $query->paginate()->withQueryString()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Locations/Create');
    }

    public function store(LocationRequest $request)
    {
        $loc = new Location();
        $loc->fill($request->all());
        $loc->code = Str::upper($request->input('code'));
        $loc->save();

        return redirect()->route('admin:locations.index')->with('success', 'Helyszín sikeresn létrehozva');
    }

    public function edit(Location $location)
    {
        return Inertia::render('Admin/Locations/Edit', [
            'location' => $location,
        ]);
    }

    public function update(LocationRequest $request, Location $location)
    {
        $location->fill($request->all());
        $location->code = Str::upper($request->input('code'));
        $location->save();

        return redirect()->route('admin:locations.index')->with('success', 'Helyszín sikeresen frissítve');
    }

    public function destroy(Location $location)
    {
        if ($location->events()->exists()) {
            return back()->with('error', 'A helyszín nem törölhető mert van hozzárendelt verseny!');
        }

        $location->delete();

        return redirect()->route('admin:locations.index')->with('success', 'Helyszín sikeresen törölve');
    }
}
