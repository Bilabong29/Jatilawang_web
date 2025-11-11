// =======================
// Vite entry (biar aset img tersertakan)
// =======================
import.meta.glob(['../img/**']);

// --- Swiper v11 (modules API) ---
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

// CSS Swiper (kalau belum di-import di app.css)
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

function initGearSwiper() {
  // pastikan kontainernya PUNYA class "swiper"
  const el = document.querySelector('.gear-swiper.swiper');
  if (!el) return;

  // bersihkan instance lama (HMR)
  if (el.swiper) el.swiper.destroy(true, true);

  const swiper = new Swiper(el, {
    // daftar module yg dipakai
    modules: [Navigation, Pagination, Autoplay],

    loop: true,
    speed: 700,
    slidesPerView: 1,
    spaceBetween: 24,
    grabCursor: true,

    // --- AUTOPLAY ---
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },

    // --- PAGINATION (bullet klik) ---
    pagination: {
      el: el.querySelector('.swiper-pagination'),
      clickable: true,
    },

    // --- NAVIGATION (panah) ---
    navigation: {
      nextEl: document.querySelector('.gear-next'),
      prevEl: document.querySelector('.gear-prev'),
    },

    // responsif (opsional)
    breakpoints: {
      768:  { slidesPerView: 1.2 },
      1024: { slidesPerView: 1.4 },
      1280: { slidesPerView: 1.6 },
    },
  });

  // simpan ke element utk debug
  el.swiper = swiper;
  console.log('✅ gear-swiper ready', swiper);
}

// panggil baik DOM sudah ready atau belum (aman utk HMR)
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initGearSwiper);
} else {
  initGearSwiper();
}
if (import.meta.hot) {
  import.meta.hot.accept(() => initGearSwiper());
  import.meta.hot.dispose(() => {
    const el = document.querySelector('.gear-swiper.swiper');
    if (el?.swiper) el.swiper.destroy(true, true);
  });
}

/* ---- JS kamu yang lain tetap di bawah sini ---- */

// =======================
// Toggle show password
// =======================
document.addEventListener('click', (e) => {
  const btn = e.target.closest('[data-toggle-pass]');
  if (!btn) return;
  const inp = document.querySelector(btn.getAttribute('data-toggle-pass'));
  if (!inp) return;
  inp.type = inp.type === 'password' ? 'text' : 'password';
  btn.setAttribute('aria-pressed', inp.type !== 'password');
});

// =======================
// Toggle group selection (size, days, dll)
// =======================
document.addEventListener('click', (e) => {
  const btn = e.target.closest('[data-select]');
  if (!btn) return;

  const groupSel = btn.getAttribute('data-select');
  const value    = btn.getAttribute('data-value');
  const target   = btn.getAttribute('data-target');

  // Reset group
  document.querySelectorAll(groupSel).forEach((el) => {
    el.dataset.active = 'false';
    el.setAttribute('aria-pressed', 'false');
  });

  // Activate this
  btn.dataset.active = 'true';
  btn.setAttribute('aria-pressed', 'true');

  // Set hidden input
  const input = document.querySelector(target);
  if (input) input.value = value;
});

// =======================
// Details accordion
// =======================
document.addEventListener('click', (e) => {
  if (e.target.id === 'details-toggle' || e.target.closest('#details-toggle')) {
    const content = document.getElementById('details-more');
    const caret   = document.getElementById('details-caret');
    const isOpen  = !content.classList.contains('hidden');
    content.classList.toggle('hidden', isOpen);
    caret.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
  }
});
