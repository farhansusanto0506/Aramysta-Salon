@php
    $categoryCounts = $portfolios->countBy('category');
@endphp

<section id="koleksi-section" class="scroll-mt-20 border-t border-outline-variant/30">
    <div class="container-luxe pt-20 lg:pt-24 pb-8">
        <div data-reveal class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="eyebrow">Koleksi Karya</span>

                    @auth
                        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-primary btn-sm">
                            <span class="material-symbols-outlined text-sm leading-none">dashboard_customize</span>
                            <span>Kelola Karya</span>
                        </a>
                    @endauth
                </div>

                <h2 class="font-headline-lg text-3xl sm:text-headline-lg text-primary leading-tight">
                    Arsip Tata Rias <span class="italic text-secondary">&amp;</span> Sanggul
                </h2>
            </div>

            <p class="font-body-md text-on-surface-variant max-w-md">
                Dokumentasi hasil riasan pengantin, wisuda, lamaran, dan acara spesial dari Aramysta Salon.
            </p>
        </div>

        <div data-reveal class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <!-- Filter Kategori -->
            <div class="flex items-center gap-2 overflow-x-auto -mx-5 px-5 sm:mx-0 sm:px-0 pb-1 [scrollbar-width:none]"
                role="group" aria-label="Filter kategori karya" id="portfolioFilter">
                <button type="button" class="filter-chip is-active" data-filter="all" aria-pressed="true">
                    Semua
                    <span class="filter-chip__count">{{ $portfolios->count() }}</span>
                </button>
                @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                    <button type="button" class="filter-chip" data-filter="{{ $value }}" aria-pressed="false">
                        {{ $label }}
                        <span class="filter-chip__count">{{ $categoryCounts[$value] ?? 0 }}</span>
                    </button>
                @endforeach
            </div>

            <!-- Navigasi Geser -->
            <div class="flex items-center gap-2 shrink-0 self-end sm:self-auto">
                <button type="button" id="portfolioPrevBtn" aria-label="Geser karya ke kiri" class="carousel-btn">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                </button>
                <button type="button" id="portfolioNextBtn" aria-label="Geser karya ke kanan" class="carousel-btn">
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </button>
            </div>
        </div>
    </div>
</section>
