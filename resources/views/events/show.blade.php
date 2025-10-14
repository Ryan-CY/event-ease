@extends('layouts.app')

@section('title', 'Event Ease - Event Details')

@section('content')

<div class="max-w-3xl mx-auto mb-6">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('events.index') }}"
           class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
           ← Back to Event List
        </a>
        <a href="{{ route('events.edit', $event->id) }}"
            class="px-3 py-2 bg-orange-500 text-white text-sm rounded-lg hover:bg-yellow-500 transition">
            Edit
        </a>
    </div>
</div>

<div class="max-w-3xl mx-auto mb-6">
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

<div class="max-w-3xl mx-auto">
    <div class="flex justify-end">
        <form action="{{ route('events.destroy', $event->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this event?');">
            @csrf
            @method('DELETE')
            <button type="submit"
            class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
            Delete
            </button>
        </form>
    </div>
</div>

@endsection
