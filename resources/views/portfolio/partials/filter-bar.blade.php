<section id="koleksi-section" class="scroll-mt-24 max-w-7xl mx-auto px-6 lg:px-12 pt-20 pb-10 border-t border-outline-variant/20">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest text-secondary shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    <span class="font-subhead-uppercase text-subhead-uppercase tracking-[0.2em]">Koleksi Karya</span>
                </div>

                @auth
                    <a href="{{ route('admin.portfolios.index') }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-primary-container text-on-primary font-label-sm uppercase tracking-wider text-[11px] hover:bg-secondary transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-sm leading-none">dashboard_customize</span>
                        <span>Kelola Karya</span>
                    </a>
                @endauth
            </div>

            <h2 class="font-headline-lg text-headline-lg text-primary leading-tight">
                Arsip Tata Rias &amp; Sanggul
            </h2>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-end justify-between md:justify-end gap-4">
            <p class="font-body-md text-on-surface-variant max-w-md">
                Dokumentasi hasil riasan pengantin, wisuda, lamaran, dan acara spesial dari Aramysta Salon.
            </p>

            <!-- Tombol Navigasi Geser Kiri/Kanan -->
            <div class="flex items-center gap-2 shrink-0 self-end sm:self-auto">
                <button type="button" id="portfolioPrevBtn" aria-label="Geser karya ke kiri"
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-surface-container-lowest border border-outline-variant/30 text-primary hover:bg-primary-container hover:text-on-primary active:scale-95 flex items-center justify-center shadow-xs transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-base sm:text-lg">arrow_back</span>
                </button>
                <button type="button" id="portfolioNextBtn" aria-label="Geser karya ke kanan"
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-surface-container-lowest border border-outline-variant/30 text-primary hover:bg-primary-container hover:text-on-primary active:scale-95 flex items-center justify-center shadow-xs transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-base sm:text-lg">arrow_forward</span>
                </button>
            </div>
        </div>
    </div>
</section>