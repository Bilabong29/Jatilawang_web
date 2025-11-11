<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-900 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold mb-3">Jatilawang <span class="text-emerald-200">Adventure</span></h1>
            <p class="text-lg mb-6">Dari pendaki pemula hingga profesional, kami menyediakan peralatan terbaik untuk kenyamanan dan keamanan petualangan Anda.</p>
            <a href="/products" class="bg-white text-green-800 font-semibold py-3 px-6 rounded-full shadow hover:bg-emerald-100 transition">Mulai Petualangan</a>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
        <!-- Kategori -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cari Berdasarkan Kategori</h2>
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            @foreach(['Sepatu', 'Tas', 'Jaket', 'Tenda', 'Aksesori', 'Lainnya'] as $kategori)
                <button class="bg-gray-100 hover:bg-green-700 hover:text-white px-5 py-2 rounded-full font-medium transition">
                    {{ $kategori }}
                </button>
            @endforeach
        </div>

        <!-- Produk Unggulan -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Produk Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ([
                ['name'=>'Sepatu Gunung Eiger Anaconda 2.5','price'=>'Rp 1.399.000','img'=>'https://via.placeholder.com/300x300?text=Sepatu+Gunung'],
                ['name'=>'Tenda Camping Anterlaser (2 Orang)','price'=>'Rp 750.000','img'=>'https://via.placeholder.com/300x300?text=Tenda'],
                ['name'=>'Jaket Gunung Waterproof','price'=>'Rp 125.500','img'=>'https://via.placeholder.com/300x300?text=Jaket'],
                ['name'=>'Sleeping Bag Adventure','price'=>'Rp 861.150','img'=>'https://via.placeholder.com/300x300?text=Sleeping+Bag'],
            ] as $p)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                    <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">{{ $p['name'] }}</h3>
                        <p class="text-green-700 font-bold mb-3">{{ $p['price'] }}</p>
                        <a href="/product/detail" class="block text-center bg-green-700 text-white py-2 rounded-lg hover:bg-green-800 transition">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Bagian promosi -->
    <section class="bg-green-100 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Diskon hingga 50%</h2>
            <p class="text-gray-600 mb-10">Dapatkan harga spesial untuk perlengkapan pendakian favoritmu.</p>
            <a href="/products" class="bg-green-700 text-white py-3 px-6 rounded-full hover:bg-green-800 transition">Belanja Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-900 text-gray-100 py-10 mt-10">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-10 px-6">
            <div>
                <h3 class="text-lg font-bold mb-3">Jatilawang</h3>
                <p class="text-sm text-gray-300">Jatilawang Adventure adalah toko online perlengkapan camping dan pendakian terbaik untuk menemani setiap petualangan Anda.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-3">Jelajahi</h3>
                <ul class="space-y-1 text-gray-300 text-sm">
                    <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white">Koleksi Produk</a></li>
                    <li><a href="#" class="hover:text-white">Blog & Tips</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-3">Hubungi Kami</h3>
                <ul class="space-y-1 text-gray-300 text-sm">
                    <li>Email: support@jatilawang.com</li>
                    <li>Instagram: @jatilawang.adventure</li>
                    <li>Facebook: Jatilawang Adventure</li>
                </ul>
            </div>
        </div>
        <div class="text-center text-sm text-gray-400 mt-10">© 2025 Jatilawang Adventure. All rights reserved.</div>
    </footer>
</x-app-layout>
