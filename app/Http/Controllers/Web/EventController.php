<?php

namespace App\Http\Controllers\Web;

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
        $events = Event::paginate(20);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event = new Event();
        return view('events.create', compact('event'));
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

        $validated['user_id'] = 1;  // temporary use

        $event = Event::create($validated);

        return redirect()->route('events.index')->with('success', 'New event created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('user', 'participants');
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.create', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location' => 'required|string',
        'capacity' => 'nullable|integer|max:255',
        'start' => 'required|date',
        'end' => 'required|date|after:start'
        ]);

        $validated['user_id'] = 1;  // temporary use

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
