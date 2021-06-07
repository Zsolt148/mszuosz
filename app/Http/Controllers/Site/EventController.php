<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EventController extends Controller
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
            'field' => ['in:name,period,category,location'],
        ]);

        $query = Event::query()
            ->visible()
            ->with('location');

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhereDate('start_at', $search);
        }

        if($year = request('year')) {
            if($year != 'null') {
                $query->whereYear('start_at', $year);
            }
        }

        if(request()->has(['field', 'direction'])) {
            if(request('field') == 'period') {
                $query->orderBy('start_at', request('direction'));
            }else if(request('field') == 'location') { //TODO with id

            }else {
                $query->orderBy(request('field'), request('direction'));
            }
        }else {
            $query->orderByDesc('start_at');
        }

        $years = Event::all()->pluck('start_at')->map(function ($date) {
            return $date->format('Y');
        })->unique()->toArray();

        return Inertia::render('Site/Events/Index', [
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'events' => $query->paginate(10)->withQueryString(),
            'years' => $years,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if(!$event->isVisible()) {
            abort(403);
        }

        return Inertia::render('Site/Events/Show', [
           'content' => $event->with('location')->firstWhere('id', $event->id)
        ]);
    }
}
