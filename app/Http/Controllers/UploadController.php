<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request, $name)
    {
        if($request->hasFile($name)) {
            $file = $request->file($name);
            //$filename = uniqid() . '.' . $files->getClientOriginalExtension();
            $path = $file->store('tmp', 'public');

            return ['name' => $file->getClientOriginalName(), 'value' => $path];
        }else {
            return null;
        }
    }

    public function destroy(Request $request)
    {
        dd($request->all());
    }
}
