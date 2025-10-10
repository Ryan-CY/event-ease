@extends('layouts.app')

@section('title', 'Event Ease - Event Details')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="mb-6">
        <a href="{{ route('events.index') }}"
           class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
           ← Back to Event List
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-10">{{ $event->name }}</h1>

        <div class="space-y-7 text-gray-700">
            <p><span class="font-semibold">Description: </span>{{ $event->description ?? '-' }}</p>
            <p><span class="font-semibold">Location: </span>{{ $event->location }}</p>
            <p><span class="font-semibold">Capacity: </span>{{ $event->capacity ?? '-' }}</p>
            <p><span class="font-semibold">Start: </span>{{ $event->start }}</p>
            <p><span class="font-semibold">End: </span>{{ $event->end }}</p>
        </div>

        <div class="mt-6 border-t pt-4 text-gray-700">
            <p><span class="font-semibold">Organizer: </span>{{ $event->user->name}}</p>
            <p><span class="font-semibold">email: </span>{{ $event->user->email}}</p>
        </div>
    </div>
</div>
@endsection
