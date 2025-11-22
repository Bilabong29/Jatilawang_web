@extends('admin.layout')

@section('title', 'Detail Pengguna')
@section('header', 'Detail Pengguna')

@section('content')
    <div class="bg-white p-4 rounded shadow max-w-xl">
        <h3 class="font-semibold text-lg mb-4">Informasi Pengguna</h3>

        <div class="space-y-2 text-sm">
            <div>
                <span class="font-semibold">ID:</span>
                {{ $user->user_id }}
            </div>
            <div>
                <span class="font-semibold">Username:</span>
                {{ $user->username }}
            </div>
            <div>
                <span class="font-semibold">Nama Lengkap:</span>
                {{ $user->full_name }}
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                {{ $user->email }}
            </div>
            <div>
                <span class="font-semibold">No. HP:</span>
                {{ $user->phone_number ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Alamat:</span>
                {{ $user->address ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Role:</span>
                <span class="inline-block px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-700">
                    {{ $user->role ?? 'customer' }}
                </span>
            </div>
            <div>
                <span class="font-semibold">Terdaftar Sejak:</span>
                {{ $user->created_at }}
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:underline">
                &larr; Kembali ke daftar pengguna
            </a>
        </div>
    </div>
@endsection
