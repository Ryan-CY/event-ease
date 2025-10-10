@extends('layouts.app')

@section('title', 'Event Ease - Create Event')

@section('content')

<div class="max-w-3xl mx-auto flex justify-start mb-6">
    <a href="{{ route('events.index') }}"
    class="text-left inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
    ← Back to Event List</a>
</div>

<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        {{ isset($event->id) ? 'Edit Event' : 'Create New Event' }}
    </h1>

    <form action="{{ isset($event->id) ? route('events.update', $event) : route('events.store') }}" 
        method="POST" class="space-y-6">
        @csrf
        @if (isset($event->id))
            @method('Put')
        @endif

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Event Name</label>
            <input type="text" id="name" name="name"
                value="{{ old('name', $event->name ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
             <textarea id="description" name="description" rows="5"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-500">{{ old('description', $event->description ?? '') }}</textarea>
        </div>


        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input type="text" id="location" name="location"
                value="{{ old('location', $event->location ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
            @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
            <input type="number" id="capacity" name="capacity" min="1"
                value="{{ old('capacity', $event->capacity ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-500">

        </div>

        <div>
            <label for="start" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
            <input type="datetime-local" id="start" name="start"
                value="{{ old('start', $event->start ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
            @error('start')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="end" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
            <input type="datetime-local" id="end" name="end"
                value="{{ old('end', $event->end ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
            @error('end')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit"
                class="bg-cyan-600 text-white px-5 py-2 rounded-lg shadow hover:bg-cyan-700 transition">
                {{ isset($event->id) ? 'Edit' : 'Create' }}
            </button>
        </div>
    </form>
</div>
@endsection
