@extends('admin.layout')

@section('title', 'Peminjaman')
@section('header', 'Manajemen Peminjaman')

@php
    use Illuminate\Support\Carbon;
@endphp

@section('content')
    {{-- Bar atas: judul + (opsional) filter --}}
    <div class="mb-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
        <h3 class="font-semibold text-lg text-slate-800">Daftar Peminjaman</h3>

        <form method="GET" class="flex gap-2 w-full sm:w-auto">
            <div class="relative flex-1 sm:w-56">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    🔍
                </span>
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari ID / User ID..."
                    class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-xl text-sm
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>
            <button
                class="px-4 py-2 bg-slate-900 text-white text-sm rounded-xl flex items-center gap-1
                       hover:bg-slate-800">
                Filter
            </button>
        </form>
    </div>

    {{-- Info kecil jumlah data --}}
    <div class="mb-3 text-xs text-gray-500">
        Menampilkan
        <span class="font-semibold">{{ $rentals->count() }}</span>
        dari
        <span class="font-semibold">{{ $rentals->total() }}</span>
        peminjaman.
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead>
            <tr class="border-b bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <th class="text-left px-3 py-2">ID</th>
                <th class="text-left px-3 py-2">Pengguna</th>
                <th class="text-left px-3 py-2">Tanggal</th>
                <th class="text-left px-3 py-2">Total</th>
                <th class="text-left px-3 py-2">Status</th>
                <th class="text-right px-3 py-2">Aksi</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($rentals as $rental)
                @php
                    $start = $rental->rental_start_date ? Carbon::parse($rental->rental_start_date) : null;
                    $end   = $rental->rental_end_date ? Carbon::parse($rental->rental_end_date) : null;
                    $today = Carbon::today();

                    if ($rental->return_date) {
                        $statusLabel = 'Selesai';
                        $statusColor = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                    } elseif ($start && $today->lt($start)) {
                        $statusLabel = 'Menunggu Mulai';
                        $statusColor = 'bg-slate-50 text-slate-700 border-slate-200';
                    } elseif ($start && $end && $today->between($start, $end)) {
                        $statusLabel = 'Berjalan';
                        $statusColor = 'bg-indigo-50 text-indigo-700 border-indigo-100';
                    } elseif ($end && $today->gt($end) && ! $rental->return_date) {
                        $statusLabel = 'Terlambat';
                        $statusColor = 'bg-red-50 text-red-700 border-red-100';
                    } else {
                        $statusLabel = 'Tidak Diketahui';
                        $statusColor = 'bg-gray-50 text-gray-600 border-gray-200';
                    }
                @endphp

                <tr class="hover:bg-gray-50/70">
                    {{-- ID --}}
                    <td class="px-3 py-2 text-gray-800">
                        #{{ $rental->rental_id }}
                        <div class="text-[11px] text-gray-400">
                            User ID: {{ $rental->user_id }}
                        </div>
                    </td>

                    {{-- Pengguna --}}
                    <td class="px-3 py-2">
                        <div class="text-sm font-medium text-gray-900">
                            {{ optional($rental->user)->full_name
                                ?? optional($rental->user)->username
                                ?? 'Pengguna #'.$rental->user_id }}
                        </div>
                        <div class="text-[11px] text-gray-500">
                            {{ optional($rental->user)->email }}
                        </div>
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-3 py-2 text-gray-700">
                        <div class="text-xs">
                            <span class="font-semibold text-gray-600">Mulai:</span>
                            {{ $rental->rental_start_date ? Carbon::parse($rental->rental_start_date)->format('d M Y') : '-' }}
                        </div>
                        <div class="text-xs">
                            <span class="font-semibold text-gray-600">Selesai:</span>
                            {{ $rental->rental_end_date ? Carbon::parse($rental->rental_end_date)->format('d M Y') : '-' }}
                        </div>
                        <div class="text-xs">
                            <span class="font-semibold text-gray-600">Kembali:</span>
                            {{ $rental->return_date ? Carbon::parse($rental->return_date)->format('d M Y') : '-' }}
                        </div>
                    </td>

                    {{-- Total --}}
                    <td class="px-3 py-2">
                        <span class="font-semibold text-gray-900">
                            Rp {{ number_format($rental->total_price ?? 0, 0, ',', '.') }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="px-3 py-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ $statusColor }}">
                            {{ $statusLabel }}
                        </span>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-3 py-2 text-right whitespace-nowrap">
                        <a href="{{ route('admin.rentals.show', $rental) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg border
                                  border-gray-200 text-gray-700 hover:bg-gray-50">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-3 py-6 text-center text-sm text-gray-400" colspan="6">
                        Belum ada data peminjaman.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $rentals->withQueryString()->links() }}
    </div>
@endsection
