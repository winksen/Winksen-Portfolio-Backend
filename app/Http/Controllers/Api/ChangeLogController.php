<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChangeLog;
use Illuminate\Http\Request;

class ChangeLogController extends Controller
{
    public function index()
    {
        $changeLogs = ChangeLog::all();

        $formattedChangeLogs = $changeLogs->map(function ($log) {
            return [
                'id' => $log->id,
                'type' => $log->type,
                'details' => [
                    'name' => $log->name,
                    'href' => $log->href,
                    'version' => $log->version,
                ],
                'comment' => $log->comment,
                'date' => $log->created_at->diffForHumans(),
            ];
        });

        return response()->json($formattedChangeLogs);
    }

    public function show($id)
    {
        $changelog = ChangeLog::find($id);

        if (!$changelog) {
            return response()->json(['error' => 'ChangeLog not found'], 404);
        }

        $responseData = [
            'id' => $changelog->id,
            'type' => 'newPage',
            'details' => [
                'name' => $changelog->name,
                'href' => $changelog->href,
                'version' => $changelog->version,
            ],
            'comment' => $changelog->comment,
            'date' => $changelog->created_at->diffForHumans(), // Assuming you have a created_at timestamp
        ];

        return response()->json($responseData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $changelog = ChangeLog::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response()->json(['changelog' => $changelog], 201);
    }

    public function update(Request $request, $id)
    {
        $changelog = ChangeLog::find($id);

        if (!$changelog) {
            return response()->json(['error' => 'ChangeLog not found'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $changelog->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response()->json(['changelog' => $changelog]);
    }

    public function destroy($id)
    {
        $changelog = ChangeLog::find($id);

        if (!$changelog) {
            return response()->json(['error' => 'ChangeLog not found'], 404);
        }

        $changelog->delete();

        return response()->json(['message' => 'ChangeLog deleted successfully']);
    }

    public function filterByTag($tagId)
    {
        $columnName = "tag" . $tagId;

        $changelogs = ChangeLog::where($columnName, true)
            ->paginate(4);

        return response()->json($changelogs);
    }
}
