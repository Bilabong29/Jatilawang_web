@extends('layouts.public')

@section('title', $product['name'].' - Jatilawang Adventure')
@section('content')
<section class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <img src="{{ asset($product['img']) }}" alt="{{ $product['name'] }}" class="rounded-2xl shadow-lg w-full object-cover">
        </div>
        <div>
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $product['name'] }}</h1>
            <p class="text-green-700 text-2xl font-semibold mb-6">{{ $product['price'] }}</p>
            <p class="text-gray-600 mb-6 leading-relaxed">{{ $product['desc'] }}</p>

            <div class="flex gap-4">
                <a href="#" class="bg-green-700 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-800 transition">
                    Sewa Sekarang
                </a>
                <a href="{{ route('products.index') }}" class="bg-gray-200 text-gray-800 py-3 px-6 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
