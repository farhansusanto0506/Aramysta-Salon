@php
    $defaultHeroImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1qiMv_hhP_ct7plZ_krd6duwoZxDCLvDhC5D4zERLUsdJ1y1-HFlMJtZCnM9g6pucgzffTbXnHEUkUp0ll-BJXGO7haHU6wU9197GlhGvIutJ_kqBcv-NgPZ6MfeMTQahyzoIiYz5m780nqgyr6JsWq-2DdEvZF-dDIOE311eOVTySLHe5DOAvQXfkV0tAijWibxYnaknugzQgpsKxYHT2msX9AgEWDxGf1kLK9UmZNTZIHR_j8QO_g';
    $heroImageUrl = !empty($content['hero_image']) 
        ? asset('storage/' . $content['hero_image']) 
        : $defaultHeroImage;
@endphp

<div class="relative w-full overflow-hidden">
    <!-- Ambient Glow -->
    <div class="absolute -top-40 right-10 w-96 h-96 bg-tertiary-fixed/30 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-80 -left-20 w-80 h-80 bg-secondary-fixed/20 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <!-- Editorial Hero Section (ID target dipasang di sini) -->
    <section id="portofolio-section" class="max-w-7xl mx-auto px-6 lg:px-12 pt-8 lg:pt-16 pb-16">
        
        @if(session('success'))
            <div class="mb-6 p-3.5 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed text-xs font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Text Column (Statis) -->
            <div class="lg:col-span-7 flex flex-col items-start pr-0 lg:pr-8">
                <div class="inline-flex items-center gap-2.5 px-3.5 py-1 rounded-full bg-surface-container-high/60 text-secondary mb-6 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    <span class="font-subhead-uppercase text-subhead-uppercase tracking-[0.2em]">
                        Portofolio — Arsip Ramysta Salon
                    </span>
                </div>

                <h1 class="font-display-lg text-display-lg text-primary tracking-tight leading-[1.08] mb-6">
                    Seni Keindahan Rias
                </h1>

                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed mb-8">
                    Temukan kurasi tata rias berkelas dari Ramysta Salon untuk pernikahan, selebrasi istimewa, dan publikasi editorial. Diciptakan dengan sentuhan kilau alami kulit yang paripurna serta keahlian artistik eksklusif.
                </p>

                <!-- Metrics Strip -->
                <div class="flex flex-wrap items-center gap-6 py-4 px-5 rounded-lg bg-surface-container-low shadow-sm mb-10 w-full max-w-xl">
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm text-primary font-medium">24</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Karya Dipublikasikan</span>
                    </div>
                    <div class="h-8 w-px bg-on-surface-variant/20"></div>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm text-primary font-medium">08</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Koleksi Editorial</span>
                    </div>
                    <div class="h-8 w-px bg-on-surface-variant/20"></div>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm text-primary font-medium">Malang &amp; Nasional</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Layanan Eksklusif</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap items-center gap-4">
                    <a class="inline-flex items-center gap-2 bg-primary-container text-on-primary font-label-md text-label-md uppercase tracking-[0.12em] px-7 py-3.5 rounded-lg transition-all duration-300 hover:bg-secondary shadow-md" href="#discovery-grid">
                        <span>Jelajahi Arsip</span>
                        <span class="material-symbols-outlined text-sm">arrow_downward</span>
                    </a>
                    <a class="inline-flex items-center gap-2 text-primary font-label-md text-label-md uppercase tracking-wider px-5 py-3.5 rounded-lg bg-surface-container-high/40 hover:bg-surface-container-high transition-colors" href="#client-love">
                        <span>Baca Ulasan Klien</span>
                    </a>
                </div>
            </div>

            <!-- Right Asymmetric Hero Visual Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden shadow-2xl bg-surface-container">
                    <img alt="Kilau Pengantin Parisienne" 
                         class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" 
                         src="{{ $heroImageUrl }}"/>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent"></div>

                    <!-- Tombol Langsung Pilih Gambar (Hanya Tampil Saat Login Admin) -->
                    @auth
                        <form action="{{ route('admin.hero.image') }}" method="POST" enctype="multipart/form-data" class="absolute top-4 left-4 z-20">
                            @csrf
                            <label class="inline-flex items-center gap-1.5 bg-primary-container/90 hover:bg-secondary text-on-primary backdrop-blur-md px-3.5 py-1.5 rounded-full shadow-lg cursor-pointer transition-colors">
                                <span class="material-symbols-outlined text-sm">photo_camera</span>
                                <span class="font-label-sm uppercase tracking-wider text-[0.65rem] font-semibold">Edit Gambar</span>
                                <input type="file" name="hero_image" accept="image/*" class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>
                    @endauth

                    <!-- Floating Top Luxury Badge -->
                    <div class="absolute top-4 right-4 bg-surface-container-lowest/90 backdrop-blur-md px-3.5 py-1.5 rounded-full shadow-lg">
                        <div class="flex items-center gap-2 text-primary">
                            <span class="material-symbols-outlined text-secondary text-sm">verified</span>
                            <span class="font-label-sm text-label-sm uppercase tracking-widest text-[0.65rem] font-semibold">
                                Edisi Eksklusif Ramysta
                            </span>
                        </div>
                    </div>

                    <!-- Bottom Floating Metadata Card -->
                    <div class="absolute bottom-5 left-5 right-5 p-5 rounded-lg bg-surface-container-lowest/95 backdrop-blur-md shadow-xl text-primary">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="font-label-sm text-label-sm uppercase tracking-[0.15em] text-secondary">
                                Karya Unggulan #01
                            </span>
                            <span class="font-label-sm text-label-sm text-on-surface-variant">
                                Tata Rias Pengantin Couture
                            </span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-primary mb-1">
                            Kilau Pengantin Parisienne
                        </h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1">
                            Tudung kasmir rose, refleksi kilau sampanye mikro &amp; kelembapan abadi.
                        </p>
                    </div>
                </div>

                <!-- Decorative offset card frame accent -->
                <div class="absolute -bottom-6 -left-6 w-36 h-36 bg-tertiary-fixed/40 rounded-xl -z-10 blur-xl"></div>
            </div>

        </div>
    </section>
</div>