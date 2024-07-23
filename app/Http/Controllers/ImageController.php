<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    use ImageTrait;
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $this->upload_image($file);
            $path = 'images/' . $fileName;
            return response()->json(['path' => $path]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function accept(Request $request)
    {
        Image::create([
            'name' => $request->fileName,
        ]);
        return response()->json(['success' => true]);
    }
    public function reject(Request $request)
    {
        $this->delete_image($request->fileName);
    }

    public function delete(Image $image)
    {
        $this->delete_image($image->name);
        $image->delete();
        return redirect()->back();
    }
}
