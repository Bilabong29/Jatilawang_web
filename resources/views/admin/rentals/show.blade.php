@extends('admin.layout')

@section('title', 'Detail Peminjaman')
@section('header', 'Detail Peminjaman')

@section('content')
    <div class="bg-white p-4 rounded shadow mb-4">
        <h3 class="font-semibold text-lg mb-3">Informasi Peminjaman</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
            <div>
                <div class="mb-1"><span class="font-semibold">ID Rental:</span> {{ $rental->rental_id }}</div>
                <div class="mb-1"><span class="font-semibold">User ID:</span> {{ $rental->user_id }}</div>
                {{-- kalau relasi user sudah ada --}}
                {{-- <div class="mb-1"><span class="font-semibold">Nama User:</span> {{ $rental->user->full_name ?? $rental->user->username ?? '-' }}</div> --}}
                <div class="mb-1"><span class="font-semibold">Tanggal Mulai:</span> {{ $rental->rental_start_date }}</div>
                <div class="mb-1"><span class="font-semibold">Tanggal Selesai:</span> {{ $rental->rental_end_date }}</div>
                <div class="mb-1"><span class="font-semibold">Tanggal Kembali:</span> {{ $rental->return_date ?? '-' }}</div>
            </div>
            <div>
                <div class="mb-1"><span class="font-semibold">Total Harga:</span>
                    Rp {{ number_format($rental->total_price ?? 0, 0, ',', '.') }}
                </div>
                {{-- kalau kamu nanti tambahkan denda di tabel, bisa tampilkan di sini --}}
            </div>
        </div>
    </div>

    {{-- Kalau kamu punya relasi detail_rentals, bisa ditampilkan di sini --}}
    {{-- contoh (kalau sudah ada relasi $rental->detailRentals): --}}
    @if(isset($rental->detailRentals) && $rental->detailRentals->count())
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-lg mb-3">Item yang Dipinjam</h3>
            <table class="w-full text-sm">
                <thead>
                <tr class="border-b bg-gray-50">
                    <th class="text-left px-3 py-2">Item ID</th>
                    <th class="text-left px-3 py-2">Nama Item</th>
                    <th class="text-left px-3 py-2">Qty</th>
                    <th class="text-left px-3 py-2">Harga/Hari</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rental->detailRentals as $detail)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $detail->item_id }}</td>
                        <td class="px-3 py-2">{{ $detail->item->item_name ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $detail->quantity ?? '-' }}</td>
                        <td class="px-3 py-2">
                            Rp {{ number_format($detail->price_per_day ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('admin.rentals.index') }}" class="text-gray-600 hover:underline">&larr; Kembali ke daftar</a>
    </div>
@endsection
