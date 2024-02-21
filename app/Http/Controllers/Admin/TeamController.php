<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Imports\TeamImport;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Excel;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,short,sa,address,webpage,created_at'],
        ]);

        $query = Team::query();

        if ($search = $request->get('search')) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('SA', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $search . '%');
        }

        if ($request->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if ($request->get('trashed')) {
            $query->onlyTrashed();
        } else {
            $query->withoutTrashed();
        }

        $teams = $query->paginate()->withQueryString();

        return Inertia::render('Admin/Teams/Index', [
            'filters' => $request->all(['search', 'field', 'direction']),
            'teams' => TeamResource::collection($teams),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Teams/Create');
    }

    public function store(TeamRequest $request)
    {
        Team::create($request->all());

        return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen létrehozva');
    }

    public function import()
    {
        return Inertia::render('Admin/Teams/Import');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['file', 'mimes:xls,xlsx']
        ], [], [
            'file' => 'Fájl'
        ]);

        $import = new TeamImport();
        Excel::import($import, $request->file('file'));

        return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen frissítve');
    }

    public function edit(Team $team)
    {
        return Inertia::render('Admin/Teams/Edit', [
            'team' => TeamResource::make($team),
        ]);
    }

    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return redirect()->back()->with('success', 'Egyesület sikeresen frissítve');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen törölve');
    }

    public function restore(Team $team)
    {
        $team->restore();

        return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen visszaállítva');
    }

    public function forceDelete(Team $team)
    {
        $team->forceDelete();

        return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen törölve');
    }
}
