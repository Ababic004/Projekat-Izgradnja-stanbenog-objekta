<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GradiFirma')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
<div class="min-h-screen flex">
    <aside class="w-64 bg-white border-r">
        <div class="p-4 font-semibold">
            <div class="text-lg">GradiFirma</div>
            <div class="text-xs text-gray-500">Upravljački sistem</div>
        </div>

        <nav class="px-2 pb-4 text-sm">
            <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('dashboard') }}">Dashboard</a>

            <div class="mt-2 text-xs text-gray-400 px-3">ADMIN</div>
            <a class="block px-3 py-2 rounded border rounded hover:bg-gray-100" href="{{ route('admin.projects.index') }}">Projekti</a>

            <a href="{{ route('admin.documents.index') }}"
            class="block px-3 py-2 rounded border border-gray-300 bg-white text-black hover:bg-gray-100">Dokumenta </a>
        </nav>
    </aside>

    <main class="flex-1">
        <header class="h-14 bg-white border-b flex items-center justify-between px-6">
            <form method="GET" action="" class="w-1/2">
                <input name="q" value="{{ request('q') }}" placeholder="Pretraži..."
                       class="w-full rounded-md border-gray-200 text-sm" />
            </form>

            <div class="text-sm text-gray-600">
                {{ auth()->user()->name }} ({{ auth()->user()->is_admin ? 'Administrator' : 'Korisnik' }})
            </div>
        </header>

        <div class="p-6">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-50 border border-green-200 p-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>
</body>
</html>

