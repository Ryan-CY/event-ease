@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="max-w-3xl mx-auto">
    <a href="{{ route('events.index')}}"
    class="text-left inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
        ← Back to Event List
    </a>
</div>

<div class="max-w-sm mx-auto mt-12 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-2 text-sm text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" autocomplete="off"
                   class="w-full border border-gray-300 rounded-xl shadow-md p-1.5" required>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm text-gray-700">Password</label>
            <input type="password" name="password"
                   class="w-full border border-gray-300 rounded-xl shadow-md p-1.5" required>
        </div>

        <button type="submit"
                class="w-full bg-cyan-600 text-white py-2 rounded-xl shadow-md hover:bg-cyan-700 transition">
            Login
        </button>
    </form>
</div>
@endsection
