<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::withCount('participants')->paginate(20);
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

        $validated['user_id'] = Auth::id();

        $event = Event::create($validated);

        return redirect()->route('events.index')->with('success', 'New event created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('participants.user')->loadCount('participants');
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

        $validated['user_id'] = Auth::id();

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}
