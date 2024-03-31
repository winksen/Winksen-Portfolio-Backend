<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);

        $contactData = [
            'email' => $request->input('email'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
        ];
        
        if ($request->input('company')) { $contactData['company'] = $request->input('company'); }
        if ($request->input('phone')) { $contactData['phone'] = $request->input('phone'); }
        if ($request->input('description')) { $contactData['description'] = $request->input('description'); }
        if ($request->input('source')) { $contactData['source'] = $request->input('source'); }
        
        $contact = Contact::create($contactData);

        return response()->json(['contact' => $contact], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
