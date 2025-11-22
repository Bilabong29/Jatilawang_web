@extends('admin.layout')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk')

@section('content')
    <form method="POST" action="{{ route('admin.items.store') }}" class="bg-white p-4 rounded shadow max-w-xl">
        @csrf

        <div class="mb-3">
            <label class="block mb-1">ID Produk (item_id)</label>
            <input type="number" name="item_id" value="{{ old('item_id') }}" class="border rounded w-full px-2 py-1">
            @error('item_id') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">Nama Produk</label>
            <input type="text" name="item_name" value="{{ old('item_name') }}" class="border rounded w-full px-2 py-1">
            @error('item_name') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}" class="border rounded w-full px-2 py-1">
            @error('category') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">URL Gambar</label>
            <input type="url" name="url_image" value="{{ old('url_image') }}" class="border rounded w-full px-2 py-1">
            @error('url_image') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label class="block mb-1">Harga Sewa / Hari</label>
                <input type="number" name="rental_price_per_day" value="{{ old('rental_price_per_day') }}" class="border rounded w-full px-2 py-1">
            </div>
            <div>
                <label class="block mb-1">Harga Jual</label>
                <input type="number" name="sale_price" value="{{ old('sale_price') }}" class="border rounded w-full px-2 py-1">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label class="block mb-1">Stok Sewa</label>
                <input type="number" name="rental_stock" value="{{ old('rental_stock', 0) }}" class="border rounded w-full px-2 py-1">
            </div>
            <div>
                <label class="block mb-1">Stok Jual</label>
                <input type="number" name="sale_stock" value="{{ old('sale_stock', 0) }}" class="border rounded w-full px-2 py-1">
            </div>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Denda per Hari</label>
            <input type="number" step="0.01" name="penalty_per_days" value="{{ old('penalty_per_days', 0) }}" class="border rounded w-full px-2 py-1">
        </div>

        <div class="mb-3 flex items-center gap-4">
            <label class="inline-flex items-center">
                <input type="hidden" name="is_rentable" value="0">
                <input type="checkbox" name="is_rentable" value="1" {{ old('is_rentable', 1) ? 'checked' : '' }}>
                <span class="ml-2">Bisa disewa</span>
            </label>

            <label class="inline-flex items-center">
                <input type="hidden" name="is_sellable" value="0">
                <input type="checkbox" name="is_sellable" value="1" {{ old('is_sellable', 1) ? 'checked' : '' }}>
                <span class="ml-2">Bisa dijual</span>
            </label>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="border rounded w-full px-2 py-1">{{ old('description') }}</textarea>
        </div>

        <button class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
    </form>
@endsection
    