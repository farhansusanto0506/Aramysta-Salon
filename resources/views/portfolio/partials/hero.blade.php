@php
    $heroImage = !empty($content['hero_image'])
        ? asset('storage/' . $content['hero_image'])
        : 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1000&q=85';
    $portfolioCount = $portfolios->count();
@endphp

<div class="relative w-full overflow-hidden">
    <!-- Ambient Glow -->
    <div data-parallax="-0.12"
        class="absolute -top-40 right-0 sm:right-10 w-80 h-80 sm:w-[28rem] sm:h-[28rem] bg-tertiary-fixed/40 rounded-full blur-3xl pointer-events-none -z-10">
    </div>
    <div data-parallax="0.08"
        class="absolute top-96 -left-24 w-80 h-80 bg-secondary-fixed/30 rounded-full blur-3xl pointer-events-none -z-10">
    </div>

    <!-- Hero -->
    <section id="portofolio-section" class="scroll-mt-24 container-luxe pt-8 sm:pt-12 lg:pt-16 pb-16 lg:pb-12">

        @if (session('success'))
            <div class="alert alert-success mb-8" role="status" data-alert>
                <span class="material-symbols-outlined text-lg leading-none text-secondary">check_circle</span>
                <span>{{ session('success') }}</span>
                <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                    <span class="material-symbols-outlined text-base leading-none">close</span>
                </button>
            </div>
        @endif

        @error('hero_image')
            <div class="alert alert-error mb-8" role="alert" data-alert>
                <span class="material-symbols-outlined text-lg leading-none">error</span>
                <span>{{ $message }}</span>
                <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                    <span class="material-symbols-outlined text-base leading-none">close</span>
                </button>
            </div>
        @enderror

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-14 lg:gap-12 items-center">

            <!-- Teks Hero -->
            <div class="lg:col-span-7 flex flex-col items-start lg:pr-6">

                <span class="eyebrow hero-enter mb-6" style="--d: 0">Haute Beauté &amp; Atelier · Probolinggo</span>

                <h1 class="hero-enter font-display-lg text-[2.5rem] leading-[1.08] sm:text-6xl lg:text-[4.25rem] lg:leading-[1.04] text-primary tracking-tight mb-7"
                    style="--d: 1">
                    Keanggunan Rias di Setiap
                    <em class="relative inline-block font-normal italic text-rose-gold pr-1">
                        Momen
                        <svg class="absolute left-0 -bottom-1.5 w-full h-2.5 text-gold-soft" viewBox="0 0 120 10"
                            preserveAspectRatio="none" aria-hidden="true">
                            <path d="M2 7 C 30 2, 60 2, 118 6" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                    </em>
                    Istimewa
                </h1>

                <p class="hero-enter font-body-lg text-base sm:text-body-lg text-on-surface-variant max-w-xl leading-relaxed mb-10"
                    style="--d: 2">
                    Koleksi karya tata rias dan sanggul dari Aramysta Salon untuk pernikahan, lamaran, wisuda, hingga
                    acara spesial. Dirancang menyesuaikan karakter wajah dengan hasil riasan yang halus, tahan lama, dan
                    memancarkan pesona alami Anda.
                </p>

                <!-- Statistik -->
                <div class="hero-enter w-full max-w-xl grid grid-cols-3 border-y border-outline-variant/50 mb-10"
                    style="--d: 3">
                    <div class="flex flex-col gap-1.5 py-5 pr-3 sm:pr-6">
                        <span class="font-headline-md text-2xl sm:text-[2rem] leading-none text-primary tabular-nums">
                            @if ($portfolioCount > 0)
                                <span data-count-to="{{ $portfolioCount }}">{{ $portfolioCount }}</span>
                            @else
                                20+
                            @endif
                        </span>
                        <span class="font-label-sm text-[10px] sm:text-label-sm uppercase tracking-[0.14em] text-on-surface-variant">
                            Karya Portofolio
                        </span>
                    </div>

                    <div class="flex flex-col gap-1.5 py-5 px-3 sm:px-6 border-l border-outline-variant/50">
                        <span class="font-headline-md text-base sm:text-xl xl:text-2xl leading-tight sm:whitespace-nowrap text-primary">
                            Studio <span class="italic text-secondary">&amp;</span> Home
                        </span>
                        <span class="font-label-sm text-[10px] sm:text-label-sm uppercase tracking-[0.14em] text-on-surface-variant">
                            Layanan Rias
                        </span>
                    </div>

                    <div class="flex flex-col gap-1.5 py-5 pl-3 sm:pl-6 border-l border-outline-variant/50">
                        <span class="font-headline-md text-base sm:text-xl xl:text-2xl leading-tight sm:whitespace-nowrap text-primary">Probolinggo</span>
                        <span class="font-label-sm text-[10px] sm:text-label-sm uppercase tracking-[0.14em] text-on-surface-variant">
                            Jawa Timur
                        </span>
                    </div>
                </div>

                <!-- Tombol CTA -->
                <div class="hero-enter flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-3 w-full sm:w-auto"
                    style="--d: 4">
                    <button type="button" data-target="koleksi-section" class="nav-scroll-link btn btn-primary">
                        <span>Lihat Koleksi Rias</span>
                        <span class="material-symbols-outlined text-base leading-none">arrow_downward</span>
                    </button>
                    <button type="button" data-target="kontak-section" class="nav-scroll-link btn btn-ghost">
                        <span class="material-symbols-outlined text-base leading-none">calendar_month</span>
                        <span>Reservasi Jadwal</span>
                    </button>
                </div>
            </div>

            <!-- Foto Hero -->
            <div class="lg:col-span-5 relative mx-auto w-full max-w-md lg:max-w-none">
                <div data-parallax="0.05" class="hero-enter-photo relative">
                    <!-- Cincin Ornamen -->
                    <svg class="spin-slow absolute -top-10 -right-8 sm:-top-12 sm:-right-12 w-32 h-32 sm:w-40 sm:h-40 text-gold/60 -z-10"
                        viewBox="0 0 100 100" aria-hidden="true">
                        <circle cx="50" cy="50" r="48" fill="none" stroke="currentColor" stroke-width="0.6"
                            stroke-dasharray="2 4" />
                        <circle cx="50" cy="50" r="36" fill="none" stroke="currentColor" stroke-width="0.4" />
                    </svg>

                    <!-- Bingkai Ornamen -->
                    <div class="absolute -inset-3 sm:-inset-4 translate-x-3 translate-y-3 sm:translate-x-5 sm:translate-y-5 rounded-[2rem] border border-gold/40 -z-10"
                        aria-hidden="true"></div>

                    <div
                        class="group w-full rounded-[1.75rem] overflow-hidden shadow-[var(--shadow-lift)] bg-surface-container-lowest border border-outline-variant/30 flex flex-col">

                        <!-- Foto -->
                        <div class="relative w-full aspect-[4/5] bg-surface-container overflow-hidden">
                            <img id="heroShowcaseImg" src="{{ $heroImage }}" alt="Karya Tata Rias Aramysta Salon"
                                fetchpriority="high"
                                class="w-full h-full object-cover object-top transition-transform duration-700 ease-luxe group-hover:scale-105" />

                            <!-- Edit Foto (Admin) -->
                            @auth
                                <form action="{{ route('admin.hero.image') }}" method="POST" enctype="multipart/form-data"
                                    class="absolute top-4 left-4 z-20">
                                    @csrf
                                    <label
                                        class="inline-flex items-center gap-1.5 bg-primary-container/90 hover:bg-secondary text-on-primary backdrop-blur-md px-3.5 py-2 rounded-full shadow-lg cursor-pointer transition-colors">
                                        <span class="material-symbols-outlined text-sm leading-none">photo_camera</span>
                                        <span class="font-label-sm uppercase tracking-widest text-[0.65rem] font-semibold">Edit
                                            Gambar</span>
                                        <input type="file" name="hero_image" accept="image/jpeg,image/png,image/webp"
                                            class="hidden" onchange="this.form.submit()">
                                    </label>
                                </form>
                            @endauth
                        </div>

                        <!-- Info Foto -->
                        <div class="px-6 py-5 bg-surface-container-lowest text-primary">
                            <span
                                class="inline-flex items-center gap-1.5 font-label-sm text-label-sm uppercase tracking-[0.15em] text-secondary mb-2">
                                <span class="material-symbols-outlined text-gold text-sm" style="font-variation-settings: 'FILL' 1">verified</span>
                                <span>Karya Pilihan • Signature Makeup</span>
                            </span>
                            <h3 class="font-headline-sm text-lg text-primary mb-1">
                                Flawless &amp; Timeless Bridal Look
                            </h3>
                            <p class="font-body-sm text-xs text-on-surface-variant">
                                Sentuhan riasan lembut, bercahaya alami, dan menyatu sempurna
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Dekorasi -->
                <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-tertiary-fixed/50 rounded-full -z-20 blur-2xl"
                    aria-hidden="true"></div>
            </div>

        </div>

        <!-- Petunjuk Scroll -->
        <button type="button" data-target="tentang-section"
            class="nav-scroll-link hidden lg:flex flex-col items-center gap-3 mx-auto mt-16 text-[10px] uppercase tracking-[0.3em] text-on-surface-variant hover:text-gold transition-colors">
            <span>Gulir</span>
            <span class="scroll-cue" aria-hidden="true"></span>
        </button>
    </section>

    <!-- Strip Kategori -->
    <div class="border-y border-gold-soft/60 bg-nude/50 py-4" aria-hidden="true">
        <div class="marquee">
            <div class="marquee__track">
                @for ($loopCopy = 0; $loopCopy < 2; $loopCopy++)
                    <div class="flex items-center shrink-0">
                        @foreach (['Bridal Makeup', 'Wisuda', 'Siraman', 'Sanggul & Hairdo', 'Lamaran', 'Home Service'] as $tag)
                            <span class="px-6 sm:px-8 font-headline-sm italic text-lg sm:text-xl text-cocoa/80 whitespace-nowrap">{{ $tag }}</span>
                            <span class="text-gold text-sm">✦</span>
                        @endforeach
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
