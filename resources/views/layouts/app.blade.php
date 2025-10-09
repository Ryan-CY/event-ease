<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

    <nav class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 py-3">
            <a href="{{ url('/events') }}" class="text-2xl font-semibold hover:text-cyan-100 transition">
                EventEase
            </a>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8 flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-100 text-center py-3 border-t text-gray-500 text-sm">
        <small>&copy; {{ date('Y') }} EventEase</small>
    </footer>
</body>

</html>
