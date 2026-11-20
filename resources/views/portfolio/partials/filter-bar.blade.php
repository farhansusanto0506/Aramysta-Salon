<section id="koleksi-section" class="scroll-mt-20 max-w-7xl mx-auto px-6 lg:px-12 pt-16 pb-6 border-t border-outline-variant/20">
    <!-- Baris Atas: Pencarian & Kelola Karya Admin -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="relative flex-1 max-w-md">
            <span class="material-symbols-outlined text-on-surface-variant text-lg absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">search</span>
            <input type="text" id="portfolioSearch" placeholder="Cari karya berdasarkan nuansa, teknik riasan, atau lokasi..."
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-surface-container-lowest border border-outline-variant/30 focus:border-secondary focus:ring-secondary text-xs text-primary">
        </div>

        @auth
            <div class="flex items-center gap-3 self-end sm:self-auto">
                <a href="{{ route('admin.portfolios.index') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary-container text-on-primary font-label-sm uppercase tracking-wider text-xs hover:bg-secondary transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-base leading-none">dashboard_customize</span>
                    <span>Kelola Karya</span>
                </a>
            </div>
        @endauth
    </div>

    <!-- Baris Bawah: Filter Kategori + Tombol Geser Kiri/Kanan -->
    <div class="flex items-center justify-between gap-3">
        <!-- Filter Pills (Scrollable di HP) -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <button type="button" data-category="all"
                    class="portfolio-filter-btn shrink-0 px-4 py-2 rounded-full bg-primary-container text-on-primary font-label-sm uppercase tracking-wider text-xs shadow-md transition-all cursor-pointer">
                Semua Karya ({{ $portfolios->count() }})
            </button>
            @foreach (\App\Models\Portfolio::CATEGORIES as $value =>$label)
                <button type="button" data-category="{{ $value }}"
                        class="portfolio-filter-btn shrink-0 px-4 py-2 rounded-full bg-surface-container-lowest text-on-surface border border-outline-variant/20 hover:border-secondary font-label-sm uppercase tracking-wider text-xs transition-all cursor-pointer">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <!-- Tombol Navigasi Geser (Tampil di Mobile & Desktop) -->
        <div class="flex items-center gap-2 shrink-0">
            <button type="button" id="portfolioPrevBtn" aria-label="Geser ke kiri"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-surface-container-lowest border border-outline-variant/30 text-primary hover:bg-primary-container hover:text-on-primary active:scale-95 flex items-center justify-center shadow-xs transition-all cursor-pointer">
                <span class="material-symbols-outlined text-base sm:text-lg">arrow_back</span>
            </button>
            <button type="button" id="portfolioNextBtn" aria-label="Geser ke kanan"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-surface-container-lowest border border-outline-variant/30 text-primary hover:bg-primary-container hover:text-on-primary active:scale-95 flex items-center justify-center shadow-xs transition-all cursor-pointer">
                <span class="material-symbols-outlined text-base sm:text-lg">arrow_forward</span>
            </button>
        </div>
    </div>
</section>