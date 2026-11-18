document.addEventListener('DOMContentLoaded', function () {
    // ==========================================
    // 1. FILTER KATEGORI & PENCARIAN PORTOFOLIO
    // ==========================================
    const filterButtons = document.querySelectorAll('.portfolio-filter-btn');
    const cards = document.querySelectorAll('.portfolio-card');
    const searchInput = document.getElementById('portfolioSearch');
    let currentCategory = 'all';

    function applyFilterAndSearch() {
        const query = (searchInput?.value || '').toLowerCase().trim();
        cards.forEach(card => {
            const category = card.getAttribute('data-category');
            const tags = card.getAttribute('data-tags') || '';
            const matchesCategory = currentCategory === 'all' || category === currentCategory;
            const matchesQuery = query === '' || tags.includes(query);
            card.classList.toggle('hidden', !(matchesCategory && matchesQuery));
        });
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => {
                b.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-md');
                b.classList.add('bg-surface-container-lowest', 'text-on-surface');
            });
            btn.classList.add('bg-primary-container', 'text-on-primary', 'shadow-md');
            btn.classList.remove('bg-surface-container-lowest', 'text-on-surface');
            currentCategory = btn.getAttribute('data-category');
            applyFilterAndSearch();
        });
    });

    searchInput?.addEventListener('input', applyFilterAndSearch);

    // ==========================================
    // 2. SWITCHER TAMPILAN MASONRY VS GRID
    // ==========================================
    const viewMasonryBtn = document.getElementById('viewMasonryBtn');
    const viewGridBtn = document.getElementById('viewGridBtn');

    viewGridBtn?.addEventListener('click', () => {
        viewGridBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        viewMasonryBtn?.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        cards.forEach(card => {
            card.classList.remove('lg:col-span-8');
            card.classList.add('lg:col-span-4');
        });
    });

    viewMasonryBtn?.addEventListener('click', () => {
        viewMasonryBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        viewGridBtn?.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        cards.forEach(card => {
            if (card.getAttribute('data-featured') === '1') {
                card.classList.remove('lg:col-span-4');
                card.classList.add('lg:col-span-8');
            }
        });
    });

    // ==========================================
    // 3. LIVE IMAGE PREVIEW DI HALAMAN ADMIN
    // ==========================================
    const adminImageInputs = document.querySelectorAll('input[type="file"][name="image"]');
    adminImageInputs.forEach(input => {
        input.addEventListener('change', function (e) {
            const file = e.target.files?.[0];
            if (!file) return;

            const form = input.closest('form');
            const previewImg = form?.querySelector('img');
            const previewWrap = document.getElementById('createImagePreviewWrap');

            if (previewImg) {
                previewImg.src = URL.createObjectURL(file);
            }
            if (previewWrap) {
                previewWrap.classList.remove('hidden');
                previewWrap.classList.add('flex');
            }
        });
    });

    // ==========================================
    // 4. NAVBAR SCROLLSPY & SMOOTH SCROLL
    // ==========================================
    const navLinks = document.querySelectorAll('.nav-scroll-link');
    const sections = [
        document.getElementById('portofolio-section'),
        document.getElementById('koleksi-section'),
        document.getElementById('testimoni-section')
    ].filter(Boolean);

    if (navLinks.length && sections.length) {
        const setActive = (id) => {
            navLinks.forEach(link => {
                const active = link.dataset.target === id;
                link.classList.toggle('text-primary', active);
                link.classList.toggle('font-semibold', active);
                link.classList.toggle('border-b-2', active);
                link.classList.toggle('border-secondary', active);
                link.classList.toggle('text-on-surface-variant', !active);
            });
        };

        const updateOnScroll = () => {
            // Titik deteksi 200px dari atas viewport (tepat di bawah navbar)
            const scrollPos = window.scrollY + 200;
            let currentId = sections[0].id;

            for (const sec of sections) {
                const top = sec.getBoundingClientRect().top + window.scrollY;
                if (scrollPos >= top) {
                    currentId = sec.id;
                }
            }

            // Jika sudah mentok paling bawah halaman, pastikan sesi terakhir aktif
            if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 20) {
                currentId = sections[sections.length - 1].id;
            }

            setActive(currentId);
        };

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const target = document.getElementById(link.dataset.target);
                if (target) {
                    e.preventDefault();
                    setActive(link.dataset.target);
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Toggle expand teks deskripsi pada kartu portofolio
    document.querySelectorAll('.toggle-desc-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.querySelector('.desc-text')?.classList.toggle('truncate');
            btn.querySelector('.desc-icon')?.classList.toggle('rotate-90');
        });
    });

        window.addEventListener('scroll', updateOnScroll, { passive: true });
        updateOnScroll();
    }
});