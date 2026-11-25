<section class="bg-ivory/60">
<div class="container-luxe pb-16 lg:pb-20">
    <!-- Carousel Karya -->
    <div id="portfolioSliderTrack"
        class="flex gap-5 sm:gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pt-3 pb-10 -mx-5 px-5 sm:mx-0 sm:px-0 scroll-px-5 sm:scroll-px-0 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">

        @forelse ($portfolios as $item)
            <article
                data-card-reveal
                class="portfolio-card group relative isolate shrink-0 snap-start w-[82%] sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)]"
                data-category="{{ $item->category }}">

                <span class="card-shadow absolute inset-0 -z-10 rounded-[1.5rem] shadow-[var(--shadow-lift)]"
                    aria-hidden="true"></span>

                <!-- Gambar Karya -->
                <div
                    class="card-media relative aspect-[4/5] w-full overflow-hidden rounded-[1.5rem] bg-surface-container border border-outline-variant/30 shadow-[var(--shadow-soft)]">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy"
                        class="w-full h-full object-cover object-center" />

                    <!-- Overlay -->
                    <div class="card-shade absolute inset-0 bg-linear-to-t from-primary/80 via-primary/15 to-transparent">
                    </div>
                    <div class="card-shade card-shade--hover absolute inset-0 bg-linear-to-t from-primary/90 via-primary/40 to-transparent">
                    </div>

                    <span class="card-frame" aria-hidden="true"></span>

                    <!-- Aksi Admin -->
                    @auth
                        <div class="absolute top-3.5 right-3.5 flex items-center gap-1.5 z-10">
                            <a href="{{ route('admin.portfolios.edit', $item) }}"
                                class="w-9 h-9 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm text-primary hover:bg-secondary hover:text-on-primary flex items-center justify-center shadow-md transition-colors"
                                title="Edit Karya">
                                <span class="material-symbols-outlined text-base">edit</span>
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Hapus karya ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-9 h-9 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm text-error hover:bg-error hover:text-on-error flex items-center justify-center shadow-md transition-colors"
                                    title="Hapus Karya">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                </button>
                            </form>
                        </div>
                    @endauth

                    @if ($item->is_featured)
                        <span class="badge absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-sm text-secondary">
                            <span class="material-symbols-outlined text-[13px] leading-none">star</span>
                            Unggulan
                        </span>
                    @endif

                    <!-- Judul & Deskripsi -->
                    <div class="card-caption absolute inset-x-5 bottom-5 text-white">
                        <span class="flex items-center justify-between gap-3 mb-2.5">
                            <span
                                class="inline-block px-2.5 py-0.5 rounded-full border border-white/30 bg-white/10 backdrop-blur-xs font-label-sm text-[10px] uppercase tracking-[0.16em] text-gold-soft">
                                {{ $item->category_label }}
                            </span>
                            <span class="card-index text-sm" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </span>
                        <h3 class="font-headline-sm text-xl text-white leading-snug mb-1.5">
                            {{ $item->title }}
                        </h3>
                        <p class="card-desc font-body-sm text-xs text-white/80 line-clamp-2">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>

            </article>
        @empty
            <div
                class="w-full py-14 px-6 text-center panel text-on-surface-variant text-sm">
                Belum ada karya portofolio yang dipublikasikan.
                @auth
                    <a href="{{ route('admin.portfolios.index') }}"
                        class="text-secondary font-semibold underline hover:text-primary transition-colors ml-1">
                        Tambahkan karya Anda sekarang
                    </a>
                @endauth
            </div>
        @endforelse

        @if ($portfolios->isNotEmpty())
            <div id="portfolioFilterEmpty" hidden
                class="w-full shrink-0 py-14 px-6 text-center panel text-on-surface-variant text-sm">
                Belum ada karya untuk kategori ini.
            </div>
        @endif
    </div>
</div>
</section>
