<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile('files')) {
            $files = $request->file('files');
            //$filename = uniqid() . '.' . $files->getClientOriginalExtension();
            $path = $files->store('files/tmp', 'public');

            return $path;
        }else {
            return null;
        }
    }

    public function destroy(Request $request)
    {
        dd($request->all());
    }
}
