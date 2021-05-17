<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
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
            'field' => ['in:name,sa,address,webpage,created_at'],
        ]);

        $query = Team::query();

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('SA', 'LIKE', '%'.$search.'%')
                ->orWhere('address', 'LIKE', '%'.$search.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Site/Teams', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'teams' => $query->paginate()->withQueryString()
        ]);
    }
}
