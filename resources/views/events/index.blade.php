@extends('layouts.app')

@section('title', 'Event Ease')

@section('content')
<div class="py-6">
    <h1 class="text-3xl font-bold text-center mb-6">Event List</h1>

    @if ($events->count() > 0)
        <div class="overflow-x-auto shadow rounded-lg">
            <table class="min-w-full text-sm text-center border border-gray-200">
                <thead class="bg-cyan-50 text-gray-700 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Event Name</th>
                        <th class="px-4 py-3 border-b">Description</th>
                        <th class="px-4 py-3 border-b">Venue</th>
                        <th class="px-4 py-3 border-b">Start</th>
                        <th class="px-4 py-3 border-b">End</th>
                        <th class="px-4 py-3 border-b">Capacity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($events as $event)
                        <tr class="hover:bg-cyan-50 transition">
                            <td class="px-4 py-3">{{ $event->id }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $event->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ Str::limit($event->description ?? '-', 70, '...') }}</td>
                            <td class="px-4 py-3">{{ $event->location }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($event->start)->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($event->end)->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3">{{ $event->capacity ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $events->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <h5 class="text-gray-500 text-lg">No events at the moment</h5>
        </div>
    @endif
</div>
@endsection
