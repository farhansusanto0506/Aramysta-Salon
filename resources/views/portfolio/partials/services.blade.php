<section id="layanan-section" class="scroll-mt-20 max-w-7xl mx-auto px-6 lg:px-12 py-20 border-t border-outline-variant/20">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
            <div class="flex flex-wrap items-center gap-3 mb-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest text-secondary shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    <span class="font-subhead-uppercase text-subhead-uppercase tracking-[0.2em]">Daftar Layanan</span>
                </div>

                @auth
                    <a href="{{ route('admin.services.index') }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-primary-container text-on-primary font-label-sm uppercase tracking-wider text-[11px] hover:bg-secondary transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-sm leading-none">spa</span>
                        <span>Kelola Layanan</span>
                    </a>
                @endauth
            </div>

            <h2 class="font-headline-lg text-headline-lg text-primary leading-tight">
                Paket &amp; Layanan Tata Rias
            </h2>
        </div>

        <p class="font-body-md text-on-surface-variant max-w-md">
            Pilihan paket tata rias Ramysta Salon untuk berbagai kebutuhan acara spesial Anda.
        </p>
    </div>

    <!-- Grid Kartu Layanan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($services as $service)
            <div class="relative rounded-2xl overflow-hidden bg-surface-container-lowest border {{ $service->is_featured ? 'border-secondary shadow-md' : 'border-outline-variant/25 shadow-xs' }} flex flex-col justify-between transition-all duration-300 hover:shadow-lg">
                
                @if ($service->is_featured)
                    <span class="absolute top-3.5 right-3.5 z-10 px-3 py-1 rounded-full bg-secondary text-on-secondary font-label-sm text-[10px] uppercase tracking-widest shadow-md">
                        Paling Diminati
                    </span>
                @endif

                <div>
                    <!-- Gambar Paket Layanan -->
                    @if ($service->image)
                        <div class="w-full bg-surface-container-low overflow-hidden border-b border-outline-variant/15">
                            <img src="{{ asset('storage/' . $service->image) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-auto block">
                        </div>
                    @endif

                    <div class="p-6">
                        <!-- Nama Paket -->
                        <h3 class="font-headline-sm text-xl text-primary mb-3">
                            {{ $service->title }}
                        </h3>

                        <!-- Daftar Harga (Per Baris) -->
                        <div class="p-3.5 rounded-xl bg-surface-container-low/80 border border-outline-variant/15 mb-4 space-y-1">
                            @foreach ($service->prices_list as $priceLine)
                                <p class="font-body-sm text-sm font-semibold text-secondary">
                                    {{ $priceLine }}
                                </p>
                            @endforeach
                        </div>

                        <!-- Rincian Layanan -->
                        <ul class="space-y-2">
                            @foreach ($service->highlights_list as $point)
                                <li class="flex items-start gap-2 text-xs text-primary leading-relaxed">
                                    <span class="text-secondary font-bold mt-0.5">•</span>
                                    <span>{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Tombol Aksi Bawah -->
                <div class="px-6 pb-6 pt-2 flex items-center gap-2">
                    <button type="button"
                            onclick="selectBookingService(@js($service->title)); document.getElementById('kontak-section')?.scrollIntoView({ behavior: 'smooth' });"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl {{ $service->is_featured ? 'bg-primary-container text-on-primary hover:bg-secondary' : 'bg-surface-container-low text-primary hover:bg-primary-container hover:text-on-primary' }} font-label-sm uppercase tracking-wider text-xs transition-colors cursor-pointer">
                        <span>Reservasi Paket</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>

                    @auth
                        <a href="{{ route('admin.services.edit', $service) }}"
                           class="w-10 h-10 rounded-xl bg-surface-container-low text-primary hover:bg-secondary hover:text-on-primary flex items-center justify-center transition-colors shrink-0"
                           title="Edit Paket">
                            <span class="material-symbols-outlined text-base">edit</span>
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-full py-14 text-center bg-surface-container-lowest rounded-2xl border border-outline-variant/20 text-on-surface-variant text-sm">
                Daftar layanan belum ditambahkan.
                @auth
                    <a href="{{ route('admin.services.index') }}" class="text-secondary font-semibold underline ml-1">Tambah paket layanan sekarang</a>
                @endauth
            </div>
        @endforelse
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