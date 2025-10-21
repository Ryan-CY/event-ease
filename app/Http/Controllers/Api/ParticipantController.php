<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function __construct()
    {
        // use middleware to protect all functions except indes and show
        $this->middleware('auth:sanctum')->except(['index', 'show', 'update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $participants = $event->participants()->latest()->paginate();
        
        return ParticipantResource::collection($participants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $event->loadCount('participants'); // have to run before authorization

        $this->authorize('create', [Participant::class, $event]);

        $participant = $event->participants()->create([
            'user_id' => $request->user()->id
        ]);

        return new ParticipantResource($participant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Participant $participant)
    {
        return new ParticipantResource($participant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Participant $participant)
    {
        $this->authorize('delete', $participant);

        $participant->delete();

        return response(status: 204);
    }
}
