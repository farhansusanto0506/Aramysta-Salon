@php
    $heroImage = !empty($content['hero_image'])
        ? asset('storage/' . $content['hero_image'])
        : 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1000&q=85';
@endphp

<div class="relative w-full overflow-hidden">
    <!-- Ambient Glow -->
    <div
        class="absolute -top-40 right-10 w-96 h-96 bg-tertiary-fixed/30 rounded-full blur-3xl pointer-events-none -z-10">
    </div>
    <div
        class="absolute top-80 -left-20 w-80 h-80 bg-secondary-fixed/20 rounded-full blur-3xl pointer-events-none -z-10">
    </div>

    <!-- Editorial Hero Section -->
    <section id="portofolio-section" class="scroll-mt-24 max-w-7xl mx-auto px-6 lg:px-12 pt-10 lg:pt-16 pb-16">
        
        @if(session('success'))
            <div class="mb-6 p-3.5 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed text-xs font-medium">
                {{ session('success') }}
            </div>
        @endif

        @error('hero_image')
            <div class="mb-6 p-3.5 rounded-xl bg-error-container/50 border border-error/30 text-on-error-container text-xs font-medium">
                {{ $message }}
            </div>
        @enderror

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">
            
            <!-- Left Text Column -->
            <div class="lg:col-span-7 flex flex-col items-start pr-0 lg:pr-8">
                <div class="inline-flex items-center gap-2.5 px-3.5 py-1 rounded-full bg-surface-container-high/60 text-secondary mb-6 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    <span class="font-subhead-uppercase text-subhead-uppercase tracking-[0.2em]">
                        Portofolio — Ramysta Salon
                    </span>
                </div>

                <h1 class="font-display-lg text-4xl sm:text-5xl lg:text-display-lg text-primary tracking-tight leading-[1.08] mb-6">
                    Keanggunan Rias di Setiap Momen Istimewa
                </h1>

                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed mb-8">
                    Koleksi karya tata rias dan sanggul dari Ramysta Salon untuk pernikahan, lamaran, wisuda, hingga acara spesial. Dirancang menyesuaikan karakter wajah dengan hasil riasan yang halus, tahan lama, dan memancarkan pesona alami Anda.
                </p>

                <!-- Metrics Strip -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 sm:gap-y-0 py-4 px-5 rounded-xl bg-surface-container-low shadow-sm mb-10 w-full max-w-xl sm:divide-x sm:divide-on-surface-variant/20">
                    <div class="flex flex-col pr-4 border-r border-on-surface-variant/20 sm:border-r-0">
                        <span class="font-headline-sm text-headline-sm text-primary font-medium">{{ $portfolios->count() ?: '20+' }}</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Karya Portofolio</span>
                    </div>

                    <div class="flex flex-col pl-4 sm:px-5">
                        <span class="font-headline-sm text-lg sm:text-headline-sm text-primary font-medium whitespace-nowrap">Studio &amp; Home</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Layanan Rias</span>
                    </div>

                    <div class="col-span-2 sm:col-span-1 flex flex-col pt-3.5 sm:pt-0 border-t border-on-surface-variant/20 sm:border-t-0 sm:pl-5">
                        <span class="font-headline-sm text-headline-sm text-primary font-medium">Probolinggo</span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Jawa Timur</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap items-center gap-4">
                    <button type="button" data-target="koleksi-section" class="nav-scroll-link inline-flex items-center gap-2 bg-primary-container text-on-primary font-label-md text-label-md uppercase tracking-[0.12em] px-7 py-3.5 rounded-lg transition-all duration-300 hover:bg-secondary shadow-md cursor-pointer">
                        <span>Lihat Koleksi Rias</span>
                        <span class="material-symbols-outlined text-sm">arrow_downward</span>
                    </button>
                    <button type="button" data-target="kontak-section" class="nav-scroll-link inline-flex items-center gap-2 text-primary font-label-md text-label-md uppercase tracking-wider px-5 py-3.5 rounded-lg bg-surface-container-high/40 hover:bg-surface-container-high transition-colors cursor-pointer">
                        <span>Reservasi Jadwal</span>
                    </button>
                </div>
            </div>

            <!-- Right Asymmetric Hero Visual Showcase -->
            <div class="lg:col-span-5 relative mt-4 lg:mt-0">
                    <div
                        class="relative w-full aspect-[4/5] rounded-xl overflow-hidden shadow-2xl bg-surface-container group">
                        <img id="heroShowcaseImg" src="{{ $heroImage }}" alt="Karya Tata Rias Ramysta Salon"
                            class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105" />

                        <!-- Tombol Edit Gambar Khusus Admin -->
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

                        <!-- Floating Top Luxury Badge -->
                        <div
                            class="absolute top-4 right-4 bg-surface-container-lowest/90 backdrop-blur-md px-3.5 py-1.5 rounded-full shadow-lg pointer-events-none">
                            <div class="flex items-center gap-2 text-primary">
                                <span class="material-symbols-outlined text-secondary text-sm">verified</span>
                                <span
                                    class="font-label-sm text-label-sm uppercase tracking-widest text-[0.65rem] font-semibold">
                                    Signature Makeup
                                </span>
                            </div>
                        </div>

                        <!-- Bottom Floating Metadata Card -->
                        <div
                            class="absolute bottom-4 left-4 right-4 p-4 rounded-lg bg-surface-container-lowest/95 backdrop-blur-md shadow-xl text-primary">
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <span class="font-label-sm text-label-sm uppercase tracking-[0.15em] text-secondary">
                                    Karya Pilihan
                                </span>
                                <span class="font-body-sm text-xs text-on-surface-variant">
                                    Ramysta Salon Probolinggo
                                </span>
                            </div>
                            <h3 class="font-headline-sm text-base text-primary mb-0.5">
                                Flawless &amp; Timeless Bridal Look
                            </h3>
                            <p class="font-body-sm text-xs text-on-surface-variant line-clamp-1">
                                Sentuhan riasan lembut, bercahaya alami, dan menyatu sempurna
                            </p>
                        </div>
                    </div>

                    <!-- Decorative offset card frame accent -->
                    <div class="absolute -bottom-6 -left-6 w-36 h-36 bg-tertiary-fixed/40 rounded-xl -z-10 blur-xl">
                    </div>
                </div>

            </div>
    </section>
</div>
