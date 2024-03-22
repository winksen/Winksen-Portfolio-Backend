<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\ChangeLog;
use Illuminate\Http\Request;

class ChangeLogController extends Controller
{
    public function index()
    {
        $changeLogs = ChangeLog::orderBy('date', 'desc')->get();

        if ($changeLogs->isEmpty()) {
            return response()->json(['message' => 'No data found.'], 404);
        }

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
                'date' => Carbon::parse($log->date)->from(),
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

    public function filterByType($typeName)
    {
        $validTypeNames = ['newPage', 'bugFix', 'pageImprovement', 'uiFix'];

        if (!in_array($typeName, $validTypeNames)) {
            return response()->json(['error' => 'Invalid type name'], 404);
        }

        $changeLogs = ChangeLog::where("type", $typeName)->orderBy('date', 'desc')->get();

        if ($changeLogs->isEmpty()) {
            return response()->json(['error' => 'No ChangeLogs found for the specified type'], 404);
        }

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
                'date' => Carbon::parse($log->date)->from(),
            ];
        });

        return response()->json($formattedChangeLogs);
    }

}
