@extends('layouts.public')

@section('title', $product['name'] . ' - Jatilawang Adventure')

@section('content')
<section class="bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-6">
      <ol class="flex items-center gap-2">
        <li>
          <a href="/" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7M3 12h18"/>
            </svg>
            Home
          </a>
        </li>
        <li class="mx-1">/</li>
        <li><a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">Produk</a></li>
        <li class="mx-1">/</li>
        <li class="font-semibold text-gray-900">{{ $product['name'] }}</li>
      </ol>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

      {{-- Gambar produk --}}
      <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6 flex items-center justify-center">
        <img src="{{ asset('storage/foto-produk/' . $product['img']) }}" alt="{{ $product['name'] }}"
             class="max-h-[420px] object-contain transition-transform duration-300 hover:scale-105">
      </div>

      {{-- Detail produk --}}
      <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3 leading-tight">{{ $product['name'] }}</h1>
        <p class="text-lg font-semibold text-emerald-900 mb-6">
          {{ $product['price'] }}
        </p>

        {{-- Deskripsi --}}
        <p class="text-gray-700 leading-relaxed mb-8">
          {{ $product['desc'] }}
        </p>

        {{-- Jumlah hari sewa --}}
        <div class="mb-6">
          <p class="font-medium text-gray-800 mb-2">Sewa Berapa Hari:</p>
          <div class="flex flex-wrap gap-2">
            @for ($i = 1; $i <= 6; $i++)
              <button
                onclick="updateTotal({{ $i }})"
                class="px-3 py-1.5 border rounded-md text-sm text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-emerald-600">
                {{ $i }}
              </button>
            @endfor
          </div>
        </div>

        {{-- Total harga sewa --}}
        @php
          // Ambil angka dari string harga (contoh: "Rp 25.000 / Hari")
          $numericPrice = (int) filter_var($product['price'], FILTER_SANITIZE_NUMBER_INT);
        @endphp
        <div class="text-gray-800 mb-6 text-lg font-semibold">
          Total Sewa:
          <span id="totalPrice" class="text-emerald-800">Rp {{ number_format($numericPrice, 0, ',', '.') }}</span>
        </div>

        {{-- Tombol aksi --}}
        <div class="flex items-center gap-4">
          <button class="flex items-center gap-2 border border-gray-300 px-5 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                      2 6.5 3.5 5 5.5 5
                      c1.54 0 3.04.99 3.57 2.36h1.87
                      C13.46 5.99 14.96 5 16.5 5
                      18.5 5 20 6.5 20 8.5
                      c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            Favorit
          </button>

          <button class="bg-emerald-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-emerald-800 transition">
            Tambahkan ke Keranjang
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Ambil harga dasar dalam angka
  const basePrice = {{ $numericPrice }};
  function updateTotal(days) {
    const total = basePrice * days;
    document.getElementById('totalPrice').textContent =
      'Rp ' + total.toLocaleString('id-ID');
  }
</script>
@endsection