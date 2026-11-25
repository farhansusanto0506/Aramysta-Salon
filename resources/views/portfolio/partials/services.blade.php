<section id="layanan-section" class="scroll-mt-20 border-t border-outline-variant/30 section-y">
    <div class="container-luxe">
        <!-- Header -->
        <div data-reveal class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="eyebrow">Daftar Layanan</span>

                    @auth
                        <a href="{{ route('admin.services.index') }}" class="btn btn-primary btn-sm">
                            <span class="material-symbols-outlined text-sm leading-none">spa</span>
                            <span>Kelola Layanan</span>
                        </a>
                    @endauth
                </div>

                <h2 class="font-headline-lg text-3xl sm:text-headline-lg text-primary leading-tight">
                    Paket <span class="italic text-secondary">&amp;</span> Layanan Tata Rias
                </h2>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-end justify-between lg:justify-end gap-4 lg:gap-8">
                <p class="font-body-md text-on-surface-variant max-w-md">
                    Pilihan paket tata rias Aramysta Salon untuk berbagai kebutuhan acara spesial Anda.
                </p>

                <!-- Navigasi Geser -->
                <div class="flex items-center gap-2 shrink-0 self-end sm:self-auto">
                    <button type="button" id="servicePrevBtn" aria-label="Geser layanan ke kiri" class="carousel-btn">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                    </button>
                    <button type="button" id="serviceNextBtn" aria-label="Geser layanan ke kanan" class="carousel-btn">
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Carousel Layanan -->
        <div id="serviceSliderTrack"
            class="flex items-stretch gap-5 sm:gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pt-6 pb-10 -mx-5 px-5 sm:mx-0 sm:px-0 scroll-px-5 sm:scroll-px-0 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">

            @forelse ($services as $service)
                <div
                    class="service-card group relative isolate shrink-0 snap-start w-[85%] sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)] flex flex-col rounded-[1.5rem] border {{ $service->is_featured ? 'border-secondary/60 bg-linear-to-b from-secondary-fixed/40 to-surface-container-lowest ring-1 ring-secondary/20' : 'border-outline-variant/40 bg-surface-container-lowest' }} shadow-[var(--shadow-soft)]">

                    <span class="card-shadow absolute inset-0 -z-10 rounded-[1.5rem] shadow-[var(--shadow-lift)]"
                        aria-hidden="true"></span>

                    @if ($service->is_featured)
                        <span
                            class="featured-badge badge absolute -top-3 left-1/2 -translate-x-1/2 z-10 px-4 py-1.5 bg-secondary text-on-secondary shadow-md">
                            <span class="material-symbols-outlined text-[13px] leading-none">star</span>
                            Paling Diminati
                        </span>
                    @endif

                    <!-- Gambar Paket -->
                    @if ($service->image)
                        <div class="m-2 mb-0 aspect-[4/5] rounded-[1.15rem] overflow-hidden bg-surface-container-low">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                loading="lazy" class="service-image w-full h-full object-cover object-top">
                        </div>
                    @endif

                    <div class="flex-1 flex flex-col p-6">
                        <!-- Nama Paket -->
                        <h3 class="font-headline-sm text-[1.35rem] leading-snug text-primary mb-4">
                            {{ $service->title }}
                        </h3>

                        <!-- Daftar Harga -->
                        <div
                            class="rounded-2xl {{ $service->is_featured ? 'bg-surface-container-lowest/80' : 'bg-surface-container-low' }} border border-outline-variant/30 px-4 py-3 mb-5">
                            <span class="block font-label-sm text-[10px] uppercase tracking-[0.18em] text-on-surface-variant mb-1.5">
                                Harga
                            </span>
                            <ul class="divide-y divide-outline-variant/30">
                                @foreach ($service->prices_list as $priceLine)
                                    <li class="py-1.5 font-headline-sm text-base text-secondary leading-snug">
                                        {{ $priceLine }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Rincian Layanan -->
                        <ul class="space-y-2.5 mb-6">
                            @foreach ($service->highlights_list as $point)
                                <li class="flex items-start gap-2.5 text-[13px] text-on-surface-variant leading-relaxed">
                                    <span class="material-symbols-outlined text-[15px] leading-5 text-secondary shrink-0">check</span>
                                    <span>{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Tombol Aksi -->
                        <div class="mt-auto flex items-center gap-2">
                            <button type="button"
                                onclick="selectBookingService(@js($service->title)); document.getElementById('kontak-section')?.scrollIntoView({ behavior: 'smooth' });"
                                class="cta-btn btn flex-1 {{ $service->is_featured ? 'btn-primary' : 'btn-ghost' }}">
                                <span>Reservasi Paket</span>
                                <span class="cta-arrow material-symbols-outlined text-base leading-none">arrow_forward</span>
                            </button>

                            @auth
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-ghost btn-icon shrink-0"
                                    title="Edit Paket">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full py-14 px-6 text-center panel text-on-surface-variant text-sm">
                    Daftar layanan belum ditambahkan.
                    @auth
                        <a href="{{ route('admin.services.index') }}" class="text-secondary font-semibold underline ml-1">Tambah
                            paket layanan sekarang</a>
                    @endauth
                </div>
            @endforelse
        </div>
    </div>
</section>

@push('scripts')
    <script>
        function selectBookingService(serviceTitle) {
            const serviceSelect = document.getElementById('waService');
            if (!serviceSelect) return;

            let exists = Array.from(serviceSelect.options).some(opt => opt.value === serviceTitle);
            if (!exists) {
                const opt = new Option(serviceTitle, serviceTitle, true, true);
                serviceSelect.add(opt, 0);
            }
            serviceSelect.value = serviceTitle;
            serviceSelect.dispatchEvent(new Event('change'));
        }
    </script>
@endpush
