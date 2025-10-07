<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        // use middleware to protect all functions except indes and show
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EventResource::collection(Event::with(['user', 'participants'])->paginate());
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

        $validated['user_id'] = $request->user()->id;

        $event = Event::create($validated);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load(['user', 'participants']);
        return new EventResource($event);
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

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response(status: 204);
    }
}
