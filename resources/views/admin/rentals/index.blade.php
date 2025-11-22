@extends('admin.layout')

@section('title', 'Peminjaman')
@section('header', 'Manajemen Peminjaman')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h3 class="font-semibold text-lg">Daftar Peminjaman</h3>

        {{-- kalau mau filter nanti bisa ditambah di sini --}}
        {{-- <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." class="border rounded px-2 py-1">
            <button class="px-3 py-1 bg-blue-500 text-white rounded">Filter</button>
        </form> --}}
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left px-3 py-2">ID</th>
                <th class="text-left px-3 py-2">User ID</th>
                <th class="text-left px-3 py-2">Mulai</th>
                <th class="text-left px-3 py-2">Selesai</th>
                <th class="text-left px-3 py-2">Kembali</th>
                <th class="text-left px-3 py-2">Total</th>
                <th class="text-left px-3 py-2">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($rentals as $rental)
                <tr class="border-b">
                    <td class="px-3 py-2">{{ $rental->rental_id }}</td>
                    <td class="px-3 py-2">{{ $rental->user_id }}</td>
                    <td class="px-3 py-2">{{ $rental->rental_start_date }}</td>
                    <td class="px-3 py-2">{{ $rental->rental_end_date }}</td>
                    <td class="px-3 py-2">
                        {{ $rental->return_date ?? '-' }}
                    </td>
                    <td class="px-3 py-2">
                        Rp {{ number_format($rental->total_price ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-3 py-2">
                        <a href="{{ route('admin.rentals.show', $rental) }}"
                           class="text-blue-500 hover:underline">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-3 py-4 text-center text-gray-500" colspan="7">
                        Belum ada data peminjaman.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $rentals->links() }}
    </div>
@endsection
