<section id="testimoni-section" class="scroll-mt-20 relative w-full bg-surface-container-low/70 border-t border-outline-variant/30 py-20 overflow-hidden">
    <!-- Ambient Glow -->
    <div class="absolute -bottom-32 right-0 w-96 h-96 bg-tertiary-fixed/25 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest text-secondary mb-4 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    <span class="font-subhead-uppercase text-subhead-uppercase tracking-[0.2em]">Ulasan Klien</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-primary leading-tight">
                    Cerita Keindahan Bersama Ramysta
                </h2>
            </div>
            <p class="font-body-md text-on-surface-variant max-w-md">
                Kepercayaan para pengantin, figur publik, dan klien istimewa yang telah mempercayakan momen berharga mereka kepada atelier kami.
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $item)
                <article class="bg-surface-container-lowest rounded-xl p-7 md:p-8 shadow-sm border border-outline-variant/20 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div>
                        <!-- Rating & Kategori -->
                        <div class="flex items-center justify-between gap-2 mb-5">
                            <div class="flex items-center gap-0.5 text-secondary">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' {{ $i <= $item->rating ? 1 : 0 }};">star</span>
                                @endfor
                            </div>
                            @if($item->category_label)
                                <span class="font-label-sm text-[10px] uppercase tracking-widest px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant">
                                    {{ $item->category_label }}
                                </span>
                            @endif
                        </div>

                        <!-- Quote -->
                        <blockquote class="font-body-md text-primary leading-relaxed mb-6 italic">
                            “{{ $item->quote }}”
                        </blockquote>
                    </div>

                    <!-- Client Info -->
                    <div class="pt-5 border-t border-surface-container flex items-center gap-3.5">
                        @if($item->avatar)
                            <img src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->client_name }}" class="w-11 h-11 rounded-full object-cover shrink-0 border border-outline-variant/40">
                        @else
                            <div class="w-11 h-11 rounded-full bg-primary-container text-tertiary-fixed flex items-center justify-center font-headline-sm text-sm uppercase shrink-0">
                                {{ substr($item->client_name, 0, 1) }}
                            </div>
                        @endif

                        <div class="min-w-0">
                            <h3 class="font-headline-sm text-base text-primary truncate">{{ $item->client_name }}</h3>
                            <p class="font-body-sm text-on-surface-variant truncate">{{ $item->event_or_role }}</p>
                        </div>
                    </div>
                </article>
            @empty
                <div class="lg:col-span-3 text-center py-14 bg-surface-container-lowest rounded-xl border border-outline-variant/20">
                    <p class="font-headline-sm text-primary mb-2">Belum ada ulasan klien yang ditampilkan.</p>
                    @auth
                        <a href="{{ route('admin.testimonials.index') }}" class="text-secondary underline text-sm">Tambah testimoni pertama di Halaman Admin</a>
                    @endauth
                </div>
            @endforelse
        </div>
    </div>
</section>