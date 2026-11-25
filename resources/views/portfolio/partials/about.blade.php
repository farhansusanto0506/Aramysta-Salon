@php
    $aboutPortfolio = $portfolios->skip(1)->first() ?? $portfolios->first();
    $aboutImage = $aboutPortfolio
        ? asset('storage/' . $aboutPortfolio->image)
        : (!empty($content['hero_image'])
            ? asset('storage/' . $content['hero_image'])
            : 'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?auto=format&fit=crop&w=900&q=80');

    $aboutStats = [
        ['value' => $portfolios->count(), 'label' => 'Karya Terdokumentasi'],
        ['value' => $services->count(), 'label' => 'Paket Layanan'],
        ['value' => count(\App\Models\Portfolio::CATEGORIES), 'label' => 'Kategori Acara'],
    ];

    $aboutPillars = [
        ['icon' => 'face_retouching_natural', 'title' => 'Riasan Personal', 'text' => 'Setiap riasan disesuaikan dengan karakter wajah, warna kulit, dan konsep acara Anda.'],
        ['icon' => 'water_drop', 'title' => 'Halus & Tahan Lama', 'text' => 'Hasil akhir yang lembut, bercahaya alami, dan tetap rapi sepanjang acara.'],
        ['icon' => 'home_pin', 'title' => 'Studio & Home Service', 'text' => 'Datang ke studio kami di Probolinggo, atau perias yang datang ke lokasi Anda.'],
        ['icon' => 'styler', 'title' => 'Rias & Busana', 'text' => 'Tersedia paket lengkap rias, sanggul, hingga busana untuk wisuda dan siraman.'],
    ];
@endphp

<section id="tentang-section" class="scroll-mt-20 relative section-y overflow-hidden">
    <div class="container-luxe grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

        <!-- Foto -->
        <div class="lg:col-span-5 relative max-w-md mx-auto w-full lg:max-w-none">
            <div data-reveal="mask" class="relative aspect-[4/5] rounded-[1.75rem] overflow-hidden bg-nude shadow-[var(--shadow-lift)]">
                <img src="{{ $aboutImage }}" alt="Tata rias Aramysta Salon" loading="lazy"
                    class="w-full h-full object-cover object-top">
                <div class="absolute inset-0 bg-linear-to-t from-primary/50 via-transparent to-transparent"></div>
                <span class="absolute bottom-5 left-5 right-5 font-headline-sm italic text-lg text-white/95 leading-snug">
                    &ldquo;Cantik yang tetap menjadi diri Anda.&rdquo;
                </span>
            </div>

            <div data-reveal="right"
                class="absolute -bottom-8 -right-2 sm:-right-8 panel px-5 py-4 flex items-center gap-4 border-gold-soft/70">
                <span class="w-11 h-11 rounded-full bg-gold-soft/60 text-gold flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1">location_on</span>
                </span>
                <span class="flex flex-col">
                    <span class="font-headline-sm text-base text-primary leading-tight">Probolinggo</span>
                    <span class="text-[10px] uppercase tracking-[0.18em] text-on-surface-variant">Jawa Timur</span>
                </span>
            </div>
        </div>

        <!-- Profil -->
        <div class="lg:col-span-7 flex flex-col gap-8 pt-6 lg:pt-0">
            <div data-reveal>
                <div class="flex items-center gap-4 mb-4">
                    <span class="section-num">01</span>
                    <span class="eyebrow">Tentang Kami</span>
                </div>
                <h2 class="font-headline-lg text-3xl sm:text-headline-lg text-primary leading-tight mb-5">
                    Sentuhan Rias yang <span class="italic text-rose-gold">Memancarkan</span> Pesona Anda
                </h2>
                <p class="font-body-md text-on-surface-variant leading-relaxed max-w-2xl">
                    Aramysta Salon adalah layanan tata rias dan sanggul di Kota Probolinggo untuk pernikahan, lamaran,
                    wisuda, siraman, hingga acara spesial lainnya. Kami percaya riasan terbaik adalah yang menonjolkan
                    keindahan alami, sehingga Anda tampil percaya diri di setiap momen berharga.
                </p>
            </div>

            <!-- Statistik -->
            <div data-reveal class="grid grid-cols-3 border-y border-gold-soft/70">
                @foreach ($aboutStats as $stat)
                    <div class="flex flex-col gap-1.5 py-5 {{ $loop->first ? 'pr-3' : 'px-3 sm:px-6 border-l border-gold-soft/70' }}">
                        <span class="font-display-lg text-3xl sm:text-[2.75rem] leading-none text-primary tabular-nums">
                            <span data-count-to="{{ $stat['value'] }}">{{ $stat['value'] }}</span>
                        </span>
                        <span class="text-[10px] sm:text-label-sm uppercase tracking-[0.14em] text-on-surface-variant">
                            {{ $stat['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Keunggulan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($aboutPillars as $pillar)
                    <div data-reveal="zoom" class="pillar-card group flex items-start gap-4 p-5 rounded-2xl bg-ivory border border-outline-variant/40">
                        <span class="pillar-icon w-11 h-11 rounded-full bg-nude text-cocoa flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">{{ $pillar['icon'] }}</span>
                        </span>
                        <span class="flex flex-col gap-1">
                            <span class="font-headline-sm text-base text-primary">{{ $pillar['title'] }}</span>
                            <span class="text-[13px] leading-relaxed text-on-surface-variant">{{ $pillar['text'] }}</span>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
