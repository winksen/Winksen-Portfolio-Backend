<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Get the ID of the last featured blog
        $lastFeaturedGalleryId = Gallery::where('isFeatured', true)
            ->orderBy('created_at', 'desc')
            ->value('id');

        // Get all galleries except the last featured one
        $galleries = Gallery::where('id', '!=', $lastFeaturedGalleryId)->with('images')->paginate(4);

        return response()->json($galleries);
    }

    public function showFeatured()
    {
        // return response()->json(['message' => 'No data found.'], 404);
        $gallery = Gallery::where('isFeatured', true)->latest()->first();

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        return response()->json($gallery);
    }

    public function show($id)
    {
        $gallery = Gallery::withCount('images')->with('images')->find($id);

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        return response()->json($gallery);
    }

    public function getOtherGalleries($id)
    {
        // Retrieve the current gallery
        $currentGallery = Gallery::findOrFail($id);

        // Retrieve other galleries excluding the current one
        $otherGalleries = Gallery::where('id', '!=', $id)->latest()->limit(4)->get();

        return response()->json($otherGalleries);
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

    public function filterByTag($tagId)
    {
        $columnName = "tag" . $tagId;

        $galleries = Gallery::where($columnName, true)
            ->paginate(4);

        return response()->json($galleries);
    }
}
