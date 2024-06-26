<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Identity;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lastFeaturedIdentityId = Identity::where('isFeatured', true)
            ->orderBy('date', 'desc')
            ->value('id');

        $identities = Identity::where('id', '!=', $lastFeaturedIdentityId)->paginate(2);

        return response()->json($identities);
    }

    public function showFeatured()
    {
        $identity = Identity::where('isFeatured', true)->latest()->first();
        // $identity->formatted_date = Carbon::parse($identity->date)->format('F Y');

        if (!$identity) {
            return response()->json(['error' => 'Identity not found'], 404);
        }

        return response()->json($identity);
    }

    public function show($id)
    {
        $identity = Identity::find($id);
        $identity->formatted_date = Carbon::parse($identity->date)->format('F Y');

        if (!$identity) {
            return response()->json(['error' => 'Identity not found'], 404);
        }

        return response()->json($identity);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Identity $identity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Identity $identity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Identity $identity)
    {
        //
    }
}
