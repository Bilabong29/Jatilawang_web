@extends('admin.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard Admin')

@php
    use Illuminate\Support\Carbon;
@endphp

@section('content')
    {{-- Kartu ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Peminjaman</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalRentals ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 text-lg">
                    📦
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                Akumulasi semua transaksi peminjaman.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Produk</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalItems ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 text-lg">
                    🎒
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                Item perlengkapan outdoor aktif di katalog.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Pengguna</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 text-lg">
                    👤
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                Akun yang terdaftar di sistem.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Review</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">{{ $totalReviews ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 text-lg">
                    ⭐
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                Feedback yang diberikan oleh pengguna.
            </p>
        </div>
    </div>

    {{-- Pendapatan + panel info --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Pendapatan Rental</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">
                Rp {{ number_format($totalRevenueRentals ?? 0, 0, ',', '.') }}
            </p>
            <p class="mt-2 text-xs text-gray-500">
                Nilai ini diambil dari total harga pada tabel peminjaman.
            </p>
        </div>

        <div class="space-y-4">
            <div class="bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl text-white p-4 shadow-sm">
                <h3 class="font-semibold mb-1">Selamat datang di dashboard admin</h3>
                <p class="text-sm text-indigo-100">
                    Pantau statistik utama seperti peminjaman, produk, pengguna, dan review dari satu tempat.
                    Gunakan menu di kiri untuk mengelola data lebih detail.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <h4 class="font-semibold text-gray-800 mb-2 text-sm">Tips cepat</h4>
                <ul class="text-sm text-gray-600 space-y-1.5">
                    <li>• Cek stok produk di menu <strong>Produk</strong> agar tidak kehabisan saat high season.</li>
                    <li>• Lihat status peminjaman terbaru di menu <strong>Peminjaman</strong>.</li>
                    <li>• Awasi review untuk menjaga kualitas layanan.</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Peminjaman terbaru --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-gray-800">Peminjaman Terbaru</h3>
            <a href="{{ route('admin.rentals.index') }}"
               class="text-xs text-indigo-600 hover:text-indigo-800">
                Lihat semua &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                <tr class="border-b bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                    <th class="text-left py-2 px-2">ID</th>
                    <th class="text-left py-2 px-2">User</th>
                    <th class="text-left py-2 px-2">Mulai</th>
                    <th class="text-left py-2 px-2">Selesai</th>
                    <th class="text-left py-2 px-2">Total</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($latestRentals as $rental)
                    <tr class="hover:bg-gray-50/70">
                        <td class="py-2 px-2 text-gray-800">
                            #{{ $rental->rental_id }}
                        </td>
                        <td class="py-2 px-2 text-gray-800">
                            {{ $rental->user->full_name ?? $rental->user->username ?? 'User #'.$rental->user_id }}
                        </td>
                        <td class="py-2 px-2 text-gray-600">
                            {{ $rental->rental_start_date
                                ? Carbon::parse($rental->rental_start_date)->format('d M Y')
                                : '-' }}
                        </td>
                        <td class="py-2 px-2 text-gray-600">
                            {{ $rental->rental_end_date
                                ? Carbon::parse($rental->rental_end_date)->format('d M Y')
                                : '-' }}
                        </td>
                        <td class="py-2 px-2 font-medium text-gray-900">
                            Rp {{ number_format($rental->total_price ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-sm text-gray-400">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
