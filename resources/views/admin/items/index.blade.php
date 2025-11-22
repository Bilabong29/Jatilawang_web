@extends('admin.layout')

@section('title', 'Produk')
@section('header', 'Manajemen Produk (Items)')

@section('content')
    <div class="mb-4 flex justify-between">
        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Cari produk..."
                   class="border rounded px-2 py-1">
            <input type="text" name="category" value="{{ request('category') }}"
                   placeholder="Kategori"
                   class="border rounded px-2 py-1">
            <button class="px-3 py-1 bg-blue-500 text-white rounded">Filter</button>
        </form>

        <a href="{{ route('admin.items.create') }}"
           class="px-3 py-1 bg-green-500 text-white rounded">
            + Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left px-3 py-2">ID</th>
                <th class="text-left px-3 py-2">Gambar</th>
                <th class="text-left px-3 py-2">Nama</th>
                <th class="text-left px-3 py-2">Kategori</th>
                <th class="text-left px-3 py-2">Sewa/Hari</th>
                <th class="text-left px-3 py-2">Harga Jual</th>
                <th class="text-left px-3 py-2">Stok Sewa</th>
                <th class="text-left px-3 py-2">Stok Jual</th>
                <th class="text-left px-3 py-2">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr class="border-b">
                    <td class="px-3 py-2">{{ $item->item_id }}</td>
                    <td class="px-3 py-2">
                        @if($item->url_image)
                            <img src="{{ $item->url_image }}" alt="{{ $item->item_name }}" class="h-12 w-12 object-cover">
                        @endif
                    </td>
                    <td class="px-3 py-2">{{ $item->item_name }}</td>
                    <td class="px-3 py-2">{{ $item->category }}</td>
                    <td class="px-3 py-2">
                        Rp {{ number_format($item->rental_price_per_day ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-3 py-2">
                        Rp {{ number_format($item->sale_price ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-3 py-2">{{ $item->rental_stock }}</td>
                    <td class="px-3 py-2">{{ $item->sale_stock }}</td>
                    <td class="px-3 py-2">
                        <a href="{{ route('admin.items.edit', $item) }}"
                           class="text-blue-500 hover:underline mr-2">Edit</a>
                        <form method="POST" action="{{ route('admin.items.destroy', $item) }}"
                              class="inline"
                              onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $items->withQueryString()->links() }}
    </div>
@endsection
