<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // return response()->json(['error' => 'Gallery not found'], 404);
        // return response()->json([]);
        $blogs = Blog::paginate(4);
        return response()->json($blogs);
    }

    public function showFeatured()
    {
        return response()->json(['message' => 'No data found.'], 404);
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['error' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['error' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $blog = Blog::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response()->json(['blog' => $blog], 201);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['error' => 'Blog not found'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $blog->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response()->json(['blog' => $blog]);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['error' => 'Blog not found'], 404);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully']);
    }

    public function filterByTag($tagId)
    {
        $columnName = "tag" . $tagId;

        $blogs = Blog::where($columnName, true)
            ->paginate(4);

        return response()->json($blogs);
    }
}
