<div class="relative w-full overflow-hidden">
    <!-- Ambient Glow -->
    <div class="absolute -top-40 right-10 w-96 h-96 bg-tertiary-fixed/30 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-80 -left-20 w-80 h-80 bg-secondary-fixed/20 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <!-- Editorial Hero Section -->
    <section id="portofolio-section" class="scroll-mt-20 max-w-7xl mx-auto px-6 lg:px-12 pt-8 lg:pt-16 pb-16">
        
        @if(session('success'))
            <div class="mb-6 p-3.5 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed text-xs font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Text Column -->
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
                        <span class="font-headline-sm text-headline-sm text-primary font-medium">Probolinggo</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Lokasi</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap items-center gap-4">
                    <a class="inline-flex items-center gap-2 bg-primary-container text-on-primary font-label-md text-label-md uppercase tracking-[0.12em] px-7 py-3.5 rounded-lg transition-all duration-300 hover:bg-secondary shadow-md" href="#koleksi-section">
                        <span>Jelajahi Arsip</span>
                        <span class="material-symbols-outlined text-sm">arrow_downward</span>
                    </a>
                    <a class="inline-flex items-center gap-2 text-primary font-label-md text-label-md uppercase tracking-wider px-5 py-3.5 rounded-lg bg-surface-container-high/40 hover:bg-surface-container-high transition-colors" href="#testimoni-section">
                        <span>Baca Ulasan Klien</span>
                    </a>
                </div>
            </div>

            <!-- Right Asymmetric Hero Google Maps Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="w-full rounded-xl overflow-hidden shadow-2xl bg-surface-container-lowest border border-outline-variant/30 flex flex-col">
                    <!-- Area Peta (Bebas dari halangan kartu) -->
                    <div class="relative w-full aspect-[4/3] bg-surface-container">
                        <iframe 
                            src="https://maps.google.com/maps?q=Ramysta+Salon,+Jl.+Hos+Cokroaminoto+No.221,+Kebonsari+Kulon,+Kec.+Kanigaran,+Kota+Probolinggo,+Jawa+Timur+67213&t=&z=16&ie=UTF8&iwloc=&output=embed"
                            class="w-full h-full border-0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Ramysta Salon Probolinggo">
                        </iframe>

                        <!-- Floating Top Luxury Badge -->
                        <div class="absolute top-3 right-3 bg-surface-container-lowest/95 backdrop-blur-md px-3 py-1.5 rounded-full shadow-md pointer-events-none">
                            <div class="flex items-center gap-1.5 text-primary">
                                <span class="material-symbols-outlined text-secondary text-sm">location_on</span>
                                <span class="font-label-sm text-label-sm uppercase tracking-widest text-[0.6rem] font-semibold">
                                    Lokasi Ramysta Salon
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Alamat di Bawah Peta -->
                    <div class="p-5 bg-surface-container-lowest text-primary border-t border-outline-variant/20">
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <span class="font-label-sm text-label-sm uppercase tracking-[0.15em] text-secondary">
                                Studio Utama
                            </span>
                            <a href="https://maps.app.goo.gl/WMjQfeGMHohh8ZXC6" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-1 font-label-sm text-[11px] font-semibold text-secondary hover:underline">
                                <span>Buka Maps</span>
                                <span class="material-symbols-outlined text-xs">open_in_new</span>
                            </a>
                        </div>
                        <h3 class="font-headline-sm text-base text-primary mb-1">
                            Ramysta Salon
                        </h3>
                        <p class="font-body-sm text-xs text-on-surface-variant">
                            Jl. Hos Cokroaminoto No.221, Kebonsari Kulon, Kec. Kanigaran, Kota Probolinggo, Jawa Timur 67213
                        </p>
                    </div>
                </div>

                <!-- Decorative offset card frame accent -->
                <div class="absolute -bottom-6 -left-6 w-36 h-36 bg-tertiary-fixed/40 rounded-xl -z-10 blur-xl"></div>
            </div>

        </div>
    </section>
</div>