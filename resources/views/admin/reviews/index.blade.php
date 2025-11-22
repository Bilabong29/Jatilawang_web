@extends('admin.layout')

@section('title', 'Review Pengguna')
@section('header', 'Review Pengguna')

@section('content')
    <div class="mb-4">
        <h3 class="font-semibold text-lg mb-2">Daftar Review</h3>
        <p class="text-sm text-gray-600">
            Admin hanya dapat <strong>melihat</strong> review yang diberikan pengguna.
        </p>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left px-3 py-2">ID</th>
                <th class="text-left px-3 py-2">User</th>
                <th class="text-left px-3 py-2">Produk / Key</th>
                <th class="text-left px-3 py-2">Rating</th>
                <th class="text-left px-3 py-2">Komentar</th>
                <th class="text-left px-3 py-2">Status</th>
                <th class="text-left px-3 py-2">Tanggal</th>
            </tr>
            </thead>
            <tbody>
            @forelse($reviews as $review)
                <tr class="border-b align-top">
                    <td class="px-3 py-2">
                        {{ $review->id }}
                    </td>
                    <td class="px-3 py-2">
                        {{-- gunakan relasi user kalau ada --}}
                        @if($review->relationLoaded('user') || $review->user)
                            {{ $review->user->full_name ?? $review->user->username ?? 'User #'.$review->user_id }}
                            <div class="text-xs text-gray-500">
                                {{ $review->user->email ?? '' }}
                            </div>
                        @else
                            User #{{ $review->user_id }}
                        @endif
                    </td>
                    <td class="px-3 py-2">
                        {{ $review->product_key }}
                    </td>
                    <td class="px-3 py-2">
                        {{ $review->rating }} / 5
                    </td>
                    <td class="px-3 py-2 max-w-md">
                        {{ $review->comment }}
                    </td>
                    <td class="px-3 py-2">
                        @if($review->verified)
                            <span class="inline-block px-2 py-0.5 rounded text-xs bg-green-100 text-green-700">
                                Terverifikasi
                            </span>
                        @else
                            <span class="inline-block px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-700">
                                Belum verifikasi
                            </span>
                        @endif
                    </td>
                    <td class="px-3 py-2">
                        {{ $review->created_at }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-3 py-4 text-center text-gray-500" colspan="7">
                        Belum ada review dari pengguna.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
@endsection
