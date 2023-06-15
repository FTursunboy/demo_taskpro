<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Uploadcontroller extends Controller
{
    public function store(Request $request) {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/docs/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'file' => $file,
                'filename' => $filename
            ]);

            return $folder;
        }
        return '';
    }
}
