<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Babi')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    

</head>
<body class="bg-gray-50 text-gray-900">
<div class="min-h-screen flex">
    <aside class="w-64 bg-white border-r">
        <div class="p-4 font-semibold">
            <div class="text-lg">Babi</div>
            <div class="text-xs text-gray-500">Upravljački sistem</div>
        </div>

        <nav class="px-2 pb-4 text-sm">
          
        @php
            $isDashboard = request()->routeIs('dashboard');
            $isProjects = request()->routeIs('admin.projects.*');
            $isDocuments = request()->routeIs('admin.documents.*');
            $isProcurements = request()->routeIs('admin.procurements.*');
            $isMyProcurements = request()->routeIs('procurements.*');

            $navItem = function (bool $active) {
                return 'block px-3 py-2 rounded border hover:bg-gray-100 ' .
                    ($active ? 'bg-gray-100 font-semibold border-gray-300' : 'bg-white text-black border-gray-300');
            };
        @endphp

        <a href="{{ route('dashboard') }}"
        class="{{ $navItem($isDashboard) }}">
        Dashboard
        </a>

        @if(auth()->user()->is_admin)
             {{-- ADMIN --}}
            <a href="{{ route('admin.projects.index') }}"
            class="{{ $navItem($isProjects) }}">
            Projekti
            </a>

            <a href="{{ route('admin.documents.index') }}"
            class="{{ $navItem($isDocuments) }}">
            Dokumenta
            </a>

            <a href="{{ route('admin.procurements.index') }}"
            class="{{ $navItem($isProcurements) }}">
            Nabavke
            </a>

        @endif
        
        @if(!auth()->user()->is_admin)
            <div class="mt-2 text-xs text-gray-400 px-3">KORISNIK</div>

            <a href="{{ route('procurements.create') }}"
            class="{{ request()->routeIs('procurements.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} block px-4 py-2 rounded">
                Pošalji zahtev za nabavku
            </a>
        @endif

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

