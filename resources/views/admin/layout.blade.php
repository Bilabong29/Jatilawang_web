<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-4 border-b">
            <h1 class="font-bold text-lg">Jatilawang Admin</h1>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
                Dashboard
            </a>
            <a href="{{ route('admin.items.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
                Produk (Items)
            </a>
            <a href="{{ route('admin.rentals.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
                Peminjaman
            </a>
            <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
                Pengguna
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
                Review
            </a>
        </nav>
    </aside>

    {{-- Konten utama --}}
    <main class="flex-1">
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h2 class="font-semibold text-xl">@yield('header', 'Dashboard')</h2>
            <div>
                <span class="mr-4">{{ auth()->user()->full_name ?? auth()->user()->username ?? '' }}</span>
                <form class="inline" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:underline">Logout</button>
                </form>
            </div>
        </header>

        <section class="p-6">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </section>
    </main>
</div>
</body>
</html>
