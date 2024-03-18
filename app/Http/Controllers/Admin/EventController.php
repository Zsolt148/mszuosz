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

    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,slug,date,category,is_visible,created_at'],
        ]);

        $query = Event::query()
            ->with('location');

        if ($search = request('search')) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('slug', 'LIKE', '%' . $search . '%')
                    ->orWhere('category', 'LIKE', '%' . $search . '%');
            });
        }

        if ($year = request('year')) {
            if ($year != 'null') {
                $query->whereYear('start_at', $year);
            }
        }

        if (request()->has(['field', 'direction'])) {
            if (request('field') == 'date') {
                $query->orderBy('start_at', request('direction'));
            } else {
                $query->orderBy(request('field'), request('direction'));
            }
        } else {
            $query->orderByDesc('start_at');
        }

        $years = Event::all()
            ->pluck('start_at')
            ->mapWithKeys(function ($date) {
                return [$date->format('Y') => $date->format('Y')];
            })
            ->unique()
            ->sortDesc()
            ->toArray();

        return Inertia::render('Admin/Events/Index', [
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'events' => $query->paginate()->withQueryString(),
            'years' => $years,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Events/Create', [
            'constants' => ['cats' => Event::CATS, 'pools' => Event::POOLS, 'timings' => Event::TIMINGS],
            'locations' => Location::query()->orderBy('Country')->orderBy('city')->orderBy('name')->get(),
        ]);
    }

    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->fill($request->except('slug', 'race_info', 'report', 'files'));

        $slug = Str::slug($request->input('slug'));
        $event->slug = $slug;
        $folder = $this->path . $slug . '/';

        Storage::disk('public')->makeDirectory($folder);

        if ($tmp = $request->input('race_info')) {
            $race_info = 'versenykiiras-' . uniqid() . '.pdf';
            $path = $folder . $race_info;
            Storage::disk('public')->move($tmp, $path);

            $event->race_info = $race_info;
        }

        if ($tmp = $request->input('report')) {
            $report = 'jegyzokonyv-' . uniqid() . '.pdf';
            $path = $folder . $report;
            Storage::disk('public')->move($tmp, $path);

            $event->report = $report;
        }

        if ($files = $request->input('files')) {
            $filesArray = array();

            foreach ($files as $file) {
                $tmppath = $file['value'];
                $arr = explode('/', $tmppath);
                $uid = array_pop($arr);

                Storage::disk('public')->move($tmppath, $folder . $uid);
                $filesArray[$file['name']] = $uid;
            }

            $event->files = $filesArray;
        }

        $event->save();

        return redirect()->route('admin:events.index')->with('success', 'Verseny sikeresen létrehozva');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/Edit', [
            'constants' => ['cats' => Event::CATS, 'pools' => Event::POOLS, 'timings' => Event::TIMINGS],
            'locations' => Location::all(),
            'event' => $event,
        ]);
    }

    public function update(EventRequest $request, Event $event)
    {
        $event->fill($request->except('slug', 'files', 'newFiles'));
        $slug = Str::slug($request->input('slug'));

        if ($event->slug != $slug) { //folder renamed
            $oldFolder = $this->path . $event->slug . '/';
            $folder = $this->path . $slug . '/';
            Storage::disk('public')->makeDirectory($folder);

            foreach (Storage::disk('public')->files($oldFolder) as $key => $path) {
                $arr = explode('/', $path);
                $filename = array_pop($arr);
                Storage::disk('public')->move($path, $folder . $filename);
            }

            Storage::disk('public')->deleteDirectory($oldFolder);
            $event->slug = $slug;
        } else {
            $folder = $this->path . $slug . '/';
        }

        if ($tmp = $request->input('race_info')) {
            $race_info = 'versenykiiras-' . uniqid() . '.pdf';
            $path = $folder . $race_info;

            if (Storage::disk('public')->exists($tmp)) {
                Storage::disk('public')->move($tmp, $path);

                $event->race_info = $race_info;
            }
        }

        if ($tmp = $request->input('report')) {
            $report = 'jegyzokonyv-' . uniqid() . '.pdf';
            $path = $folder . $report;

            if (Storage::disk('public')->exists($tmp)) {
                Storage::disk('public')->move($tmp, $path);

                $event->report = $report;
            }
        }

        if ($newFiles = $request->input('newFiles')) {
            $newFilesArray = array();

            foreach ($newFiles as $file) {
                $tmppath = $file['value'];
                $arr = explode('/', $tmppath);
                $uid = array_pop($arr);

                Storage::disk('public')->move($tmppath, $folder . $uid);
                $newFilesArray[$file['name']] = $uid;
            }
            $event->files = is_array($event->files) ? array_merge($event->files, $newFilesArray) : $newFilesArray;
        }

        $event->save();

        return redirect()->route('admin:events.index')->with('success', 'Verseny sikeresen frissítve');
    }

    public function destroy(Event $event)
    {
        Storage::disk('public')->deleteDirectory($this->path . $event->slug);

        $event->delete();

        return redirect()->route('admin:events.index')->with('success', 'Verseny sikeresn törölve');
    }

    public function deleteFile(Event $event, $field, $file)
    {
        $filepath = $this->path . $event->slug . '/' . $file;

        if (Storage::disk('public')->exists($filepath)) {
            Storage::disk('public')->delete($filepath);
        }

        if ($field == 'files') {
            $files = $event->files;
            if (($key = array_search($file, $files)) !== false) {
                unset($files[$key]);
            }
            $event->files = $files;
        } else {
            $event->{$field} = null;
        }

        $event->save();

        return redirect()->back()->with('success', 'Fájl sikeresen törölve');
    }
}
