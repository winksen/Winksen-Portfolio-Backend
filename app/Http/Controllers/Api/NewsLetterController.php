<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
    
        // Check if the email already exists
        $existingEmail = NewsLetter::where('email', $request->input('email'))->exists();
        if ($existingEmail) {
            return response()->json(['error' => 'Email already exists'], 400);
        }

        $email = NewsLetter::create([
            'email' => $request->input('email'),
            // 'option1' => $request->input('option1'),
            // 'option2' => $request->input('option2'),
            // 'option3' => $request->input('option3'),
            // 'option4' => $request->input('option4'),
        ]);

        return response()->json(['email' => $email], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsLetter $newsLetter)
    {
        //
    }
}
