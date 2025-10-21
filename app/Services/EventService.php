<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\Request;

class EventService
{
    public function store(array $data, int $userId): Event
    {
        $data['user_id'] = $userId;
        return Event::create($data);
    }

    public function update(array $data, Event $event): Event
    {
        $event->update($data);
        return $event;
    }

    public function destroy(Event $event): bool
    {
        return $event->delete();
    }
}