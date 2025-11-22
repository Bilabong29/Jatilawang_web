@extends('admin.layout')

@section('title', 'Edit Produk')
@section('header', 'Edit Produk')

@section('content')
    <form method="POST" action="{{ route('admin.items.update', $item) }}" class="bg-white p-4 rounded shadow max-w-xl">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block mb-1">ID Produk (item_id)</label>
            <input type="number" value="{{ $item->item_id }}" class="border rounded w-full px-2 py-1 bg-gray-100" disabled>
            <p class="text-xs text-gray-500 mt-1">
                ID tidak bisa diubah.
            </p>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Nama Produk</label>
            <input type="text" name="item_name"
                   value="{{ old('item_name', $item->item_name) }}"
                   class="border rounded w-full px-2 py-1">
            @error('item_name') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">Kategori</label>
            <input type="text" name="category"
                   value="{{ old('category', $item->category) }}"
                   class="border rounded w-full px-2 py-1">
            @error('category') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">URL Gambar</label>
            <input type="url" name="url_image"
                   value="{{ old('url_image', $item->url_image) }}"
                   class="border rounded w-full px-2 py-1">
            @error('url_image') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror

            @if($item->url_image)
                <div class="mt-2">
                    <span class="text-xs text-gray-500">Pratinjau:</span><br>
                    <img src="{{ $item->url_image }}" alt="{{ $item->item_name }}" class="h-20 object-cover mt-1">
                </div>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label class="block mb-1">Harga Sewa / Hari</label>
                <input type="number" name="rental_price_per_day"
                       value="{{ old('rental_price_per_day', $item->rental_price_per_day) }}"
                       class="border rounded w-full px-2 py-1">
                @error('rental_price_per_day') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block mb-1">Harga Jual</label>
                <input type="number" name="sale_price"
                       value="{{ old('sale_price', $item->sale_price) }}"
                       class="border rounded w-full px-2 py-1">
                @error('sale_price') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label class="block mb-1">Stok Sewa</label>
                <input type="number" name="rental_stock"
                       value="{{ old('rental_stock', $item->rental_stock) }}"
                       class="border rounded w-full px-2 py-1">
                @error('rental_stock') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block mb-1">Stok Jual</label>
                <input type="number" name="sale_stock"
                       value="{{ old('sale_stock', $item->sale_stock) }}"
                       class="border rounded w-full px-2 py-1">
                @error('sale_stock') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Denda per Hari</label>
            <input type="number" step="0.01" name="penalty_per_days"
                   value="{{ old('penalty_per_days', $item->penalty_per_days) }}"
                   class="border rounded w-full px-2 py-1">
            @error('penalty_per_days') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 flex items-center gap-4">
            <label class="inline-flex items-center">
                <input type="hidden" name="is_rentable" value="0">
                <input type="checkbox" name="is_rentable" value="1"
                       {{ old('is_rentable', $item->is_rentable) ? 'checked' : '' }}>
                <span class="ml-2">Bisa disewa</span>
            </label>

            <label class="inline-flex items-center">
                <input type="hidden" name="is_sellable" value="0">
                <input type="checkbox" name="is_sellable" value="1"
                       {{ old('is_sellable', $item->is_sellable) ? 'checked' : '' }}>
                <span class="ml-2">Bisa dijual</span>
            </label>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description" rows="3"
                      class="border rounded w-full px-2 py-1">{{ old('description', $item->description) }}</textarea>
            @error('description') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <button class="px-4 py-2 bg-blue-500 text-white rounded">Simpan Perubahan</button>
        <a href="{{ route('admin.items.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
@endsection
