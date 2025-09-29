<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'capacity' => 'nullable|integer|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ]);

        $validated['user_id'] = 1; // temporary use

        $event = Event::create($validated);

        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|max:255',
            'description' => 'nullable|string',
            'location' => 'sometimes|required|string',
            'capacity' => 'nullable|integer|max:255',
            'start' => 'sometimes|required|date',
            'end' => 'sometimes|required|date|after:start'
        ]);

        $event->update($validated);

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
