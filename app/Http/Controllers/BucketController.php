<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BucketController extends Controller
{

    public function store(Request $request)
    {
        $request->validate(["file" => "required"]);

        $path = "https://lrj6a9vl4is6.compat.objectstorage.uk-london-1.oraclecloud.com/nuna/lrj6a9vl4is6/nuna/public/wedding/photos/";
        $photoURL = Storage::url($request->file("file")->store("nuna/public/wedding/photos"));

        return success_response([
            "url" => $photoURL
        ], "File uploaded successfully");

    }


}
