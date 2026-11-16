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
    // 3. MODAL LIGHTBOX DETAIL KARYA (PUBLIK)
    // ==========================================
    const modal = document.getElementById('portfolioModal');
    const closeModalBtn = document.getElementById('closePortfolioModal');

    if (modal && cards.length) {
        const modalImg = document.getElementById('modalImg');
        const modalCategory = document.getElementById('modalCategory');
        const modalTitle = document.getElementById('modalTitle');
        const modalLocation = document.getElementById('modalLocation');
        const modalDesc = document.getElementById('modalDesc');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                const imgSrc = card.querySelector('img')?.src || '';
                const title = card.getAttribute('data-title') || '';
                const category = card.getAttribute('data-category-label') || '';
                const location = card.getAttribute('data-location') || '';
                const desc = card.getAttribute('data-description') || 'Sentuhan riasan eksklusif oleh Ramysta Salon.';

                modalImg.src = imgSrc;
                modalCategory.textContent = category;
                modalTitle.textContent = title;
                modalLocation.textContent = location;
                modalDesc.textContent = desc;

                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        closeModalBtn?.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    }

    // ==========================================
    // 4. LIVE IMAGE PREVIEW DI HALAMAN ADMIN
    // ==========================================
    const adminImageInputs = document.querySelectorAll('input[type="file"][name="image"]');
    adminImageInputs.forEach(input => {
        input.addEventListener('change', function (e) {
            const file = e.target.files?.[0];
            if (!file) return;

            const form = input.closest('form');
            let previewImg = form?.querySelector('img');

            if (previewImg) {
                previewImg.src = URL.createObjectURL(file);
            }
        });
    });
});