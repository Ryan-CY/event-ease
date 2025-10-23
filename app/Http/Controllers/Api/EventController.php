<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use App\Traits\EventValidationRules;
use App\Traits\LoadRelationships;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use EventValidationRules;
    use LoadRelationships;

    protected array $relations = ['user', 'participants'];

    public function __construct(protected EventService $eventService)
    {
        // use middleware to protect all functions except index and show
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->loadRelationships(Event::query());
        return EventResource::collection($query->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate($this->storeValidationRule());

        $event = $this->eventService->store($validated, $request->user()->id);

        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate($this->updateValidationRules());

        $event = $this->eventService->update($validated, $event);

        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->eventService->destroy($event);

        return response(status: 204);
    }
}
