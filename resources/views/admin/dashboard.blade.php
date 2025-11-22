@extends('admin.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-500 text-sm">Total Peminjaman</div>
            <div class="text-2xl font-bold">{{ $totalRentals }}</div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-500 text-sm">Total Produk</div>
            <div class="text-2xl font-bold">{{ $totalItems }}</div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-500 text-sm">Total Pengguna</div>
            <div class="text-2xl font-bold">{{ $totalUsers }}</div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="text-gray-500 text-sm">Total Review</div>
            <div class="text-2xl font-bold">{{ $totalReviews }}</div>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow mb-6">
        <div class="text-gray-500 text-sm">Total Pendapatan Rental</div>
        <div class="text-2xl font-bold">
            Rp {{ number_format($totalRevenueRentals ?? 0, 0, ',', '.') }}
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-2">Peminjaman Terbaru</h3>
        <table class="w-full text-sm">
            <thead>
            <tr class="border-b">
                <th class="text-left py-1">ID</th>
                <th class="text-left py-1">User</th>
                <th class="text-left py-1">Mulai</th>
                <th class="text-left py-1">Selesai</th>
                <th class="text-left py-1">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($latestRentals as $rental)
                <tr class="border-b">
                    <td class="py-1">{{ $rental->rental_id }}</td>
                    <td class="py-1">{{ $rental->user->full_name ?? $rental->user->username ?? '-' }}</td>
                    <td class="py-1">{{ $rental->rental_start_date }}</td>
                    <td class="py-1">{{ $rental->rental_end_date }}</td>
                    <td class="py-1">
                        Rp {{ number_format($rental->total_price ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
