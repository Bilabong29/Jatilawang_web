@extends('layouts.layout-admin')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            {{-- Header --}}
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-lg text-gray-900">Tambah Produk Baru</h3>
                    <p class="text-sm text-gray-600">Lengkapi informasi produk untuk disimpan ke katalog</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.items.store') }}" class="space-y-6">
                @csrf

                {{-- Nama & Kategori --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="item_name"
                            value="{{ old('item_name') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                            placeholder="Contoh: Tenda Dome 4 Orang"
                            required
                        >
                        @error('item_name')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Kategori
                        </label>
                        <select
                            name="category_selected"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        >
                            <option value="">-- Pilih kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category_selected') === $cat ? 'selected' : '' }}>
                                    {{ ucfirst($cat) }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-2">Pilih kategori yang sudah ada, atau isi kategori baru di bawah.</p>
                        @error('category_selected')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kategori Baru Opsional --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori Baru (opsional)
                    </label>
                    <input
                        type="text"
                        name="new_category"
                        value="{{ old('new_category') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        placeholder="Isi jika ingin menambahkan kategori baru"
                    >
                    @error('new_category')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- URL Gambar --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        URL Gambar <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="url"
                        name="url_image"
                        value="{{ old('url_image') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        placeholder="https://example.com/image.jpg"
                        required
                    >
                    <p class="text-xs text-gray-500 mt-2">
                        Gunakan link gambar dari CDN atau hosting eksternal
                    </p>
                    @error('url_image')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Harga Sewa / Hari
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input
                                type="number"
                                id="rental_price_per_day"
                                name="rental_price_per_day"
                                value="{{ old('rental_price_per_day') }}"
                                class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="25000"
                            >
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Harga Jual
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input
                                type="number"
                                id="sale_price"
                                name="sale_price"
                                value="{{ old('sale_price') }}"
                                class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="450000"
                            >
                        </div>
                    </div>
                </div>

                {{-- Stok --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Stok Sewa
                        </label>
                        <input
                            type="number"
                            id="rental_stock"
                            name="rental_stock"
                            value="{{ old('rental_stock', 0) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Stok Jual
                        </label>
                        <input
                            type="number"
                            id="sale_stock"
                            name="sale_stock"
                            value="{{ old('sale_stock', 0) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        >
                    </div>
                </div>

                {{-- Denda --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Denda per Hari
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                        <input
                            type="number"
                            step="0.01"
                            id="penalty_per_days"
                            name="penalty_per_days"
                            value="{{ old('penalty_per_days', 0) }}"
                            class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-3 text-sm
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                            placeholder="10000"
                        >
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        Denda keterlambatan pengembalian per hari
                    </p>
                </div>

                {{-- Status --}}
                <div class="flex flex-wrap items-center gap-6 p-4 bg-gray-50 rounded-lg">
                    <label class="inline-flex items-center text-sm text-gray-700">
                        <input type="hidden" name="is_rentable" value="0">
                        <input
                            type="checkbox"
                            name="is_rentable"
                            value="1"
                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            {{ old('is_rentable', 1) ? 'checked' : '' }}
                        >
                        <span class="ml-2 font-medium">Bisa disewa</span>
                    </label>

                    <label class="inline-flex items-center text-sm text-gray-700">
                        <input type="hidden" name="is_sellable" value="0">
                        <input
                            type="checkbox"
                            name="is_sellable"
                            value="1"
                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            {{ old('is_sellable', 0) ? 'checked' : '' }}
                        >
                        <span class="ml-2 font-medium">Bisa dijual</span>
                    </label>
                    @error('is_rentable')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        placeholder="Tuliskan detail produk, material, kegunaan, dan spesifikasi..."
                    >{{ old('description') }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.items.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg
                              hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button
                        class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg
                               hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                               transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const rentCheckbox = document.querySelector('input[name="is_rentable"][type="checkbox"]');
                const sellCheckbox = document.querySelector('input[name="is_sellable"][type="checkbox"]');

                const rentFields = [
                    document.getElementById('rental_price_per_day'),
                    document.getElementById('rental_stock'),
                    document.getElementById('penalty_per_days')
                ];

                const sellFields = [
                    document.getElementById('sale_price'),
                    document.getElementById('sale_stock')
                ];

                const toggleFields = (fields, enabled) => {
                    fields.forEach((field) => {
                        field.disabled = !enabled;
                        if (!enabled) {
                            field.value = '';
                        }
                    });
                };

                const syncState = (source) => {
                    if (source === 'rent' && rentCheckbox.checked) {
                        sellCheckbox.checked = false;
                    }

                    if (source === 'sell' && sellCheckbox.checked) {
                        rentCheckbox.checked = false;
                    }

                    // Jika keduanya aktif (misal data lama), paksa hanya satu yang tersisa
                    if (rentCheckbox.checked && sellCheckbox.checked) {
                        if (source === 'sell') {
                            rentCheckbox.checked = false;
                        } else {
                            sellCheckbox.checked = false;
                        }
                    }

                    const rentActive = rentCheckbox.checked;
                    const sellActive = sellCheckbox.checked;

                    toggleFields(rentFields, rentActive);
                    toggleFields(sellFields, sellActive);
                };

                rentCheckbox.addEventListener('change', () => syncState('rent'));
                sellCheckbox.addEventListener('change', () => syncState('sell'));

                syncState();
            });
        </script>
    @endpush
@endsection