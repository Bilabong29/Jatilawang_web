<footer class="bg-emerald-950 text-gray-200 py-16">
    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- Kolom 1: Tentang --}}
            <div>
                <h2 class="text-2xl font-extrabold text-white mb-4">Jatilawang</h2>
                <p class="text-gray-300 leading-relaxed mb-6">
                    Jatilawang Adventure adalah toko online terpercaya yang menyediakan
                    perlengkapan camping dan mendaki gunung berkualitas untuk menemani
                    setiap petualangan Anda.
                </p>

                {{-- Sosial Media --}}
                <div class="flex items-center gap-5 mt-6">
                    {{-- Twitter --}}
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 24 24" class="w-5 h-5">
                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53
                                     4.48 4.48 0 0 0-7.86 3v1A10.66
                                     10.66 0 0 1 3 4s-4 9 5 13a11.64
                                     11.64 0 0 1-7 2c9 5 20 0
                                     20-11.5a4.5 4.5 0 0 0-.08-.83
                                     A7.72 7.72 0 0 0 23 3z"/>
                        </svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 24 24" class="w-5 h-5">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.5l.5-4H14V7
                                     a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>

                    {{-- TikTok --}}
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 24 24" class="w-5 h-5">
                            <path d="M12 2c.44 0 .87.04 1.29.1v4.47a4.53 4.53 0 0 1-1.29-.26v9.11
                                     a4.59 4.59 0 1 1-4.59-4.59c.23 0 .45.02.67.05v2.49
                                     a2.1 2.1 0 1 0 2.09 2.09V2h2.83z"/>
                        </svg>
                    </a>

                    {{-- Instagram --}}
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 24 24" class="w-5 h-5">
                            <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10
                                     c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10
                                     2c1.65 0 3 1.35 3 3v10c0 1.65-1.35 3-3 3H7
                                     c-1.65 0-3-1.35-3-3V7c0-1.65 1.35-3 3-3h10z
                                     m-5 3.5A5.5 5.5 0 1 0 17.5 13 5.5 5.5 0 0 0 12 7.5z
                                     m0 9A3.5 3.5 0 1 1 15.5 13 3.5 3.5 0 0 1 12 16.5z
                                     m5.75-10.75a1.25 1.25 0 1 1-1.25-1.25 1.25 1.25 0 0 1 1.25 1.25z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Jelajahi --}}
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Jelajahi</h3>
                <ul class="space-y-3 text-gray-300">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Blog & Tips Pendakian</a></li>
                    <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Lokasi Toko</a></li>
                    <li><a href="#" class="hover:text-white transition">Program Afiliasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Kartu Hadiah (Gift Card)</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan Pelanggan --}}
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Layanan Pelanggan</h3>
                <ul class="space-y-3 text-gray-300">
                    <li><a href="#" class="hover:text-white transition">Cara Pemesanan</a></li>
                    <li><a href="#" class="hover:text-white transition">Konfirmasi Pembayaran</a></li>
                    <li><a href="#" class="hover:text-white transition">Info Pengiriman</a></li>
                    <li><a href="#" class="hover:text-white transition">Kebijakan Pengembalian</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQ (Tanya Jawab)</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>

        {{-- Garis Pemisah --}}
        <div class="border-t border-emerald-800 mt-12 pt-6 text-center text-sm text-gray-400">
            © {{ date('Y') }} Jatilawang Adventure. Semua Hak Dilindungi.
        </div>
    </div>
</footer>
