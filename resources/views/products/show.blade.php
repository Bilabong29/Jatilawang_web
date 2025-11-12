{{-- RESOURCES/VIEWS/PRODUCTS/PARTIALS/REVIEWS.BLADE.PHP --}}
<section class="bg-gray-50 py-12 border-t border-gray-200" id="reviews-section">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Ulasan Pelanggan</h2>
                <div class="flex items-center gap-2 mt-1">
                    <div class="flex text-yellow-400">
                        <span class="text-xl" id="avg-rating-stars">★★★★★</span>
                    </div>
                    <span class="text-gray-600 font-medium"><span id="avg-rating-val">0.0</span> / 5.0</span>
                    <span class="text-gray-400 text-sm">(<span id="total-reviews-count">0</span> ulasan)</span>
                </div>
            </div>
            
            @auth
            <button onclick="document.getElementById('review-form-modal').classList.remove('hidden')" 
                class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-50 transition shadow-sm">
                Tulis Ulasan
            </button>
            @else
            <a href="{{ route('login') }}" class="text-emerald-700 text-sm font-medium hover:underline">
                Login untuk mengulas
            </a>
            @endauth
        </div>

        {{-- List Review Container --}}
        <div id="reviews-list" class="space-y-6">
            <div class="text-center py-8 text-gray-500">Memuat ulasan...</div>
        </div>

        {{-- Pagination Container --}}
        <div id="reviews-pagination" class="mt-8 flex justify-center gap-2"></div>
    </div>
</section>

{{-- MODAL FORM REVIEW --}}
<div id="review-form-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Beri Rating Produk</h3>
                <form id="review-form" class="mt-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Rating Anda</label>
                        <div class="flex flex-row-reverse justify-end gap-1 text-2xl text-gray-300 cursor-pointer group">
                            {{-- Star Rating Input (CSS Trick: Reverse order for hover effect) --}}
                            <input type="radio" name="rating" value="5" id="s5" class="hidden peer/s5" required><label for="s5" class="hover:text-yellow-400 peer-checked/s5:text-yellow-400 peer-hover/s5:text-yellow-400">★</label>
                            <input type="radio" name="rating" value="4" id="s4" class="hidden peer/s4"><label for="s4" class="hover:text-yellow-400 peer-checked/s4:text-yellow-400 peer-hover/s4:text-yellow-400 peer-checked/s5:text-yellow-400 peer-hover/s5:text-yellow-400">★</label>
                            <input type="radio" name="rating" value="3" id="s3" class="hidden peer/s3"><label for="s3" class="hover:text-yellow-400 peer-checked/s3:text-yellow-400 peer-hover/s3:text-yellow-400 peer-checked/s4:text-yellow-400 peer-hover/s4:text-yellow-400 peer-checked/s5:text-yellow-400 peer-hover/s5:text-yellow-400">★</label>
                            <input type="radio" name="rating" value="2" id="s2" class="hidden peer/s2"><label for="s2" class="hover:text-yellow-400 peer-checked/s2:text-yellow-400 peer-hover/s2:text-yellow-400 peer-checked/s3:text-yellow-400 peer-hover/s3:text-yellow-400 peer-checked/s4:text-yellow-400 peer-hover/s4:text-yellow-400 peer-checked/s5:text-yellow-400 peer-hover/s5:text-yellow-400">★</label>
                            <input type="radio" name="rating" value="1" id="s1" class="hidden peer/s1"><label for="s1" class="hover:text-yellow-400 peer-checked/s1:text-yellow-400 peer-hover/s1:text-yellow-400 peer-checked/s2:text-yellow-400 peer-hover/s2:text-yellow-400 peer-checked/s3:text-yellow-400 peer-hover/s3:text-yellow-400 peer-checked/s4:text-yellow-400 peer-hover/s4:text-yellow-400 peer-checked/s5:text-yellow-400 peer-hover/s5:text-yellow-400">★</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Komentar (Opsional)</label>
                        <textarea name="comment" rows="3" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-emerald-500" placeholder="Ceritakan pengalaman Anda menggunakan produk ini..."></textarea>
                    </div>
                    <div id="review-error" class="text-red-500 text-sm mb-2 hidden"></div>
                </form>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="submitReview()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-700 text-base font-medium text-white hover:bg-emerald-800 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Kirim Ulasan
                </button>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT LOGIC --}}
<script>
    // KUNCI: Mengambil slug produk dari Blade untuk dipakai di URL API
    const productSlug = "{{ $product->slug }}"; 
    const reviewsApiUrl = `/products/${productSlug}/reviews`;

    document.addEventListener("DOMContentLoaded", function() {
        fetchReviews();
    });

    function closeModal() {
        document.getElementById('review-form-modal').classList.add('hidden');
        document.getElementById('review-error').classList.add('hidden');
    }

    // 1. FUNGSI MENGAMBIL DATA REVIEW (GET)
    function fetchReviews(url = reviewsApiUrl) {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                renderReviews(data.reviews.data);
                renderStats(data.stats);
            })
            .catch(error => console.error('Error fetching reviews:', error));
    }

    // 2. FUNGSI MENAMPILKAN REVIEW KE HTML
    function renderReviews(reviews) {
        const container = document.getElementById('reviews-list');
        container.innerHTML = '';

        if (reviews.length === 0) {
            container.innerHTML = '<p class="text-center text-gray-500 italic">Belum ada ulasan untuk produk ini.</p>';
            return;
        }

        reviews.forEach(review => {
            const date = new Date(review.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
            const stars = '★'.repeat(review.rating) + '☆'.repeat(5 - review.rating);
            
            const html = `
                <div class="border-b border-gray-100 pb-6 last:border-0">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs">
                                ${review.user ? review.user.name.substring(0,2).toUpperCase() : 'AN'}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">${review.user ? review.user.name : 'Pengguna'}</p>
                                <p class="text-xs text-gray-400">${date}</p>
                            </div>
                        </div>
                        <div class="text-yellow-400 text-sm tracking-widest">${stars}</div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">${review.comment || ''}</p>
                </div>
            `;
            container.innerHTML += html;
        });
    }

    function renderStats(stats) {
        document.getElementById('avg-rating-val').textContent = stats.avg;
        document.getElementById('total-reviews-count').textContent = stats.total;
        // Update bintang rata-rata
        const avgStars = Math.round(stats.avg);
        document.getElementById('avg-rating-stars').textContent = '★'.repeat(avgStars) + '☆'.repeat(5 - avgStars);
    }

    // 3. FUNGSI KIRIM REVIEW (POST)
    function submitReview() {
        const form = document.getElementById('review-form');
        const formData = new FormData(form);
        const errorDiv = document.getElementById('review-error');

        // Ambil CSRF Token dari meta tag Laravel (Pastikan ada di layout) atau input hidden
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch(reviewsApiUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Gagal mengirim ulasan.');
            }
            // Sukses
            closeModal();
            form.reset();
            fetchReviews(); // Refresh list
            alert('Ulasan berhasil dikirim!');
        })
        .catch(error => {
            errorDiv.textContent = error.message;
            errorDiv.classList.remove('hidden');
        });
    }
</script>