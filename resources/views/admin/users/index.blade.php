@extends('admin.layout')

@section('title', 'Pengguna')
@section('header', 'Daftar Pengguna')

@section('content')
    <div class="mb-4">
        <h3 class="font-semibold text-lg mb-2">Daftar Pengguna</h3>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left px-3 py-2">ID</th>
                <th class="text-left px-3 py-2">Username</th>
                <th class="text-left px-3 py-2">Nama</th>
                <th class="text-left px-3 py-2">Email</th>
                <th class="text-left px-3 py-2">Role</th>
                <th class="text-left px-3 py-2">Terdaftar</th>
                <th class="text-left px-3 py-2">Detail</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr class="border-b">
                    <td class="px-3 py-2">{{ $user->user_id }}</td>
                    <td class="px-3 py-2">{{ $user->username }}</td>
                    <td class="px-3 py-2">{{ $user->full_name }}</td>
                    <td class="px-3 py-2">{{ $user->email }}</td>
                    <td class="px-3 py-2">
                        <span class="inline-block px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-700">
                            {{ $user->role ?? 'customer' }}
                        </span>
                    </td>
                    <td class="px-3 py-2">{{ $user->created_at }}</td>
                    <td class="px-3 py-2">
                        <a href="{{ route('admin.users.show', $user) }}"
                           class="text-blue-500 hover:underline">
                            Lihat
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-3 py-4 text-center text-gray-500" colspan="7">
                        Belum ada data pengguna.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
