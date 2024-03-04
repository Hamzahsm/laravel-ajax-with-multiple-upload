<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    //
    public function index()
    {
        return view('upload-image');
    }

    public function save(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('image')) {
            $fileName =  "image-" . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('image', $fileName);

            $image = new Image;
            $image->image = $fileName;
            $image->save();

            return response()->json(["image" => $fileName]);
        }
    }
}
