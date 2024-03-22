<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $lastFeaturedGalleryId = Gallery::where('isFeatured', true)
            ->orderBy('date', 'desc')
            ->value('id');

        $galleries = Gallery::where('id', '!=', $lastFeaturedGalleryId)->withCount('images')->with('images')->paginate(4);

        $galleries->getCollection()->transform(function ($gallery) {
            $gallery->formatted_date = Carbon::parse($gallery->date)->format('F Y');
            // $gallery->difference_date = Carbon::parse($gallery->date)->from();

            $gallery->images->transform(function ($image) {
                $image->formatted_date = Carbon::parse($image->date)->format('F d, Y');
                return $image;
            });

            return $gallery;
        });

        return response()->json($galleries);
    }

    public function showFeatured()
    {
        $gallery = Gallery::where('isFeatured', true)->withCount('images')->latest()->first();
        $gallery->formatted_date = Carbon::parse($gallery->date)->format('F Y');

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        return response()->json($gallery);
    }

    public function show($id)
    {
        $gallery = Gallery::withCount('images')->with('images')->find($id);
        $gallery->formatted_date = Carbon::parse($gallery->date)->format('F Y');

        $gallery->images->transform(function ($image) {
            $image->formatted_date = Carbon::parse($image->date)->format('F d, Y');
            return $image;
        });

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
        $otherGalleries = Gallery::where('id', '!=', $id)->withCount('images')->latest()->limit(4)->get();

        $otherGalleries->transform(function ($gallery) {
            $gallery->formatted_date = Carbon::parse($gallery->date)->format('F Y');
            return $gallery;
        });

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
