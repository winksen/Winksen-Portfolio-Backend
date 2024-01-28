<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('images')->paginate(4);
        return response()->json($galleries);
    }
    public function show($id)
    {
        $gallery = Gallery::with('images')->find($id);

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        return response()->json($gallery);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $gallery = Gallery::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response()->json(['gallery' => $gallery], 201);
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $gallery->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response()->json(['gallery' => $gallery]);
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        $gallery->delete();

        return response()->json(['message' => 'Gallery deleted successfully']);
    }
}
