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
                        <!-- Rating Bintang -->
                        <div class="flex items-center gap-0.5 text-secondary mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' {{ $i <= $item->rating ? 1 : 0 }};">star</span>
                            @endfor
                        </div>

                        <!-- Isi Testimoni -->
                        <blockquote class="font-body-md text-primary leading-relaxed mb-6 italic">
                            “{{ $item->quote }}”
                        </blockquote>
                    </div>

                    <!-- Nama Klien -->
                    <div class="pt-4 border-t border-surface-container">
                        <h3 class="font-headline-sm text-base text-primary">{{ $item->client_name }}</h3>
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