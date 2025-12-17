@extends('layouts.layout-admin')

@section('title', 'Detail Pengguna')
@section('header', 'Detail Pengguna')

@php
    use Illuminate\Support\Carbon;
    $role = $user->role ?? 'customer';
    $roleColors = [
        'admin' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
        'staff' => 'bg-amber-100 text-amber-800 border-amber-200', 
        'customer' => 'bg-gray-100 text-gray-800 border-gray-200',
    ];
    $roleLabels = [
        'admin' => 'ADMIN',
        'staff' => 'STAFF',
        'customer' => 'CUSTOMER',
    ];
@endphp

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            {{-- Header --}}
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg">
                    {{ substr($user->full_name ?: $user->username, 0, 1) }}
                </div>
                <div>
                    <h3 class="font-semibold text-lg text-gray-900">Detail Pengguna</h3>
                    <p class="text-sm text-gray-600">Informasi lengkap data pengguna</p>
                </div>
            </div>

            {{-- Informasi Pengguna --}}
            <div class="space-y-6">
                {{-- ID & Role --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ID Pengguna</label>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-mono font-bold text-gray-900">#{{ $user->user_id }}</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $roleColors[$role] }}">
                                {{ $roleLabels[$role] }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Akun</label>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span class="text-sm font-medium text-gray-900">Aktif</span>
                        </div>
                    </div>
                </div>

                {{-- Informasi Pribadi --}}
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-3 text-sm">Informasi Pribadi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium text-gray-700">Username:</span>
                                <p class="text-gray-900 mt-1">{{ $user->username }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Nama Lengkap:</span>
                                <p class="text-gray-900 mt-1">{{ $user->full_name ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium text-gray-700">Email:</span>
                                <p class="text-gray-900 mt-1">{{ $user->email ?: '-' }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">No. Telepon:</span>
                                <p class="text-gray-900 mt-1">{{ $user->phone_number ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Tambahan --}}
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-3 text-sm">Informasi Tambahan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-700">Alamat:</span>
                            <p class="text-gray-900 mt-1">{{ $user->address ?: 'Tidak ada alamat' }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Terdaftar Sejak:</span>
                            <p class="text-gray-900 mt-1">
                                {{ $user->created_at ? Carbon::parse($user->created_at)->format('d F Y') : '-' }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $user->created_at ? Carbon::parse($user->created_at)->format('H:i:s') : '' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Info edit --}}
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                    <h4 class="font-semibold text-blue-800 mb-2 text-sm">Pengelolaan</h4>
                    <p class="text-sm text-blue-700">Data ini dapat diedit melalui tombol "Edit Pengguna" di bawah.</p>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-100">
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 
                          border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Pengguna
                    </a>
                    <span class="text-xs text-gray-400">
                        Terakhir dilihat: {{ now()->format('d M Y H:i') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection