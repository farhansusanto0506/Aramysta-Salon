<section class="sticky top-20 z-30 bg-[#FAF7F2]/95 backdrop-blur-md py-5 transition-all shadow-sm" id="discovery-grid">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-4">
        <!-- Controls Row: Search + View Switcher -->
        <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
            <div class="relative flex-1 max-w-md">
                <span
                    class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
                <input
                    class="w-full h-11 pl-10 pr-4 bg-surface-container-lowest text-primary placeholder:text-on-surface-variant/60 font-body-sm text-body-sm rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary/30 transition-all"
                    id="portfolioSearch" placeholder="Cari karya berdasarkan nuansa, teknik riasan, atau lokasi..."
                    type="text" />
            </div>

            <div class="flex items-center gap-3 self-end md:self-auto">
                <div class="flex items-center bg-surface-container-high/60 p-1 rounded-lg">
                    <button aria-label="Tampilan Editorial Masonry"
                        class="p-1.5 rounded bg-surface-container-lowest text-primary shadow-sm hover:text-secondary transition-all"
                        id="viewMasonryBtn" type="button">
                        <span class="material-symbols-outlined text-lg leading-none">dashboard</span>
                    </button>
                    <button aria-label="Tampilan Kisi Seragam"
                        class="p-1.5 rounded text-on-surface-variant hover:text-primary transition-all" id="viewGridBtn"
                        type="button">
                        <span class="material-symbols-outlined text-lg leading-none">grid_view</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 pt-1 scrollbar-none" id="filterContainer">
            <button
                class="portfolio-filter-btn shrink-0 px-4 py-2 rounded-full font-label-sm text-label-sm uppercase tracking-wider transition-all duration-200 bg-primary-container text-on-primary shadow-md"
                data-category="all">
                Semua Karya ({{ $portfolios->count() }})
            </button>
            <button
                class="portfolio-filter-btn shrink-0 px-4 py-2 rounded-full font-label-sm text-label-sm uppercase tracking-wider transition-all duration-200 bg-surface-container-lowest text-on-surface hover:bg-surface-container-high shadow-sm"
                data-category="bridal">
                Pengantin Couture
            </button>
            <button
                class="portfolio-filter-btn shrink-0 px-4 py-2 rounded-full font-label-sm text-label-sm uppercase tracking-wider transition-all duration-200 bg-surface-container-lowest text-on-surface hover:bg-surface-container-high shadow-sm"
                data-category="red-carpet">
                Red Carpet &amp; Gala
            </button>
            <button
                class="portfolio-filter-btn shrink-0 px-4 py-2 rounded-full font-label-sm text-label-sm uppercase tracking-wider transition-all duration-200 bg-surface-container-lowest text-on-surface hover:bg-surface-container-high shadow-sm"
                data-category="editorial">
                Editorial &amp; Fashion
            </button>
            <button
                class="portfolio-filter-btn shrink-0 px-4 py-2 rounded-full font-label-sm text-label-sm uppercase tracking-wider transition-all duration-200 bg-surface-container-lowest text-on-surface hover:bg-surface-container-high shadow-sm"
                data-category="soft-glam">
                Soft Glam
            </button>
        </div>
    </div>
</section>
