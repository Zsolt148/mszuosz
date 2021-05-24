<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Models\Event;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EventController extends Controller
{
    protected $path = 'events/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,slug,date,category,is_visible,created_at'],
        ]);

        $query = Event::query()
            ->with('location');

        if($search = request('search')) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('slug', 'LIKE', '%'.$search.'%')
                ->orWhere('category', 'LIKE', '%'.$search.'%');
        }

        if($year = request('year')) {
            if($year != 'null') {
                $query->whereYear('start_at', $year);
            }
        }

        if(request()->has(['field', 'direction'])) {
            if(request('field') == 'date') {
                $query->orderBy('start_at', request('direction'));
            }else {
                $query->orderBy(request('field'), request('direction'));
            }
        }else {
            $query->latest();
        }

        $years = Event::all()->pluck('start_at')->map(function ($date) {
           return $date->format('Y');
        })->unique()->toArray();

        return Inertia::render('Admin/Events/Index', [
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'events' => $query->paginate()->withQueryString(),
            'years' => $years,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Events/Create', [
            'constants' => ['cats' => Event::CATS, 'pools' => Event::POOLS, 'timings' => Event::TIMINGS],
            'locations' => Location::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->fill($request->except('slug', 'race_info', 'report', 'files'));

        $slug = Str::slug($request->input('slug'));
        $event->slug = $slug;
        $folder = $this->path . $slug . '/';

        Storage::disk('public')->makeDirectory($folder);

        if($tmp = $request->input('race_info')) {
            $race_info = 'versenykiiras-' . uniqid() . '.pdf';
            $path = $folder . $race_info;
            Storage::disk('public')->move($tmp, $path);

            $event->race_info = $race_info;
        }

        if($tmp = $request->input('report')) {
            $report = 'jegyzokonyv-' . uniqid() . '.pdf';
            $path = $folder . $report;
            Storage::disk('public')->move($tmp, $path);

            $event->report = $report;
        }

        //TODO files
        if($files = $request->input('files')) {
            foreach($files as $tmp) {

                //Storage::disk('public')->move($tmp);
            }
        }

        $event->save();

        return redirect()->route('admin:events.index')->with('success', 'Verseny sikeresen létrehozva');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/Edit', [
            'constants' => ['cats' => Event::CATS, 'pools' => Event::POOLS, 'timings' => Event::TIMINGS],
            'locations' => Location::all(),
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->fill($request->except('slug'));
        $event->slug = Str::slug($request->input('slug'));
        $event->save();

        return redirect()->back()->with('success', 'Verseny sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin:events.index')->with('success', 'Verseny sikeresn törölve');
    }
}
