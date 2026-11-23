<section class="max-w-7xl mx-auto px-6 lg:px-12 pb-16">
    <!-- Carousel Karya -->
    <div id="portfolioSliderTrack"
         class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
        
        @forelse ($portfolios as $item)
            <article class="portfolio-card shrink-0 snap-start w-[84%] sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)] bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-outline-variant/20 flex flex-col"
                     data-category="{{ $item->category }}"
                     data-tags="{{ strtolower($item->title . ' ' . $item->category_label . ' ' . $item->description . ' ' . ($item->location ?? '')) }}"
                     data-featured="{{ $item->is_featured ? '1' : '0' }}">
                
                <!-- Gambar Karya -->
                <div class="relative aspect-[4/5] w-full overflow-hidden bg-surface-container group">
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         alt="{{ $item->title }}" 
                         class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105" />

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>

                    <!-- Aksi Admin -->
                    @auth
                        <div class="absolute top-3.5 right-3.5 flex items-center gap-1.5 z-10">
                            <a href="{{ route('admin.portfolios.edit', $item) }}" 
                               class="w-8 h-8 rounded-full bg-surface-container-lowest/90 text-primary hover:bg-secondary hover:text-on-primary flex items-center justify-center shadow-md transition-colors"
                               title="Edit Karya">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus karya ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-8 h-8 rounded-full bg-surface-container-lowest/90 text-error hover:bg-error hover:text-on-error flex items-center justify-center shadow-md transition-colors cursor-pointer"
                                        title="Hapus Karya">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    @endauth

                    <!-- Judul & Deskripsi -->
                    <div class="card-caption absolute bottom-4 left-4 right-4 text-white">
                        <span class="inline-block px-2.5 py-0.5 rounded-full bg-white/15 backdrop-blur-xs font-label-sm text-[10px] uppercase tracking-wider text-secondary-fixed mb-2">
                            {{ $item->category_label }}
                        </span>
                        <h3 class="font-headline-sm text-lg text-white leading-snug mb-1">
                            {{ $item->title }}
                        </h3>
                        <p class="font-body-sm text-xs text-white/80 line-clamp-2">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>

            </article>
        @empty
            <div class="w-full py-14 text-center bg-surface-container-lowest rounded-2xl border border-outline-variant/20 text-on-surface-variant text-sm">
                Belum ada karya portofolio yang dipublikasikan.
                @auth
                    <a href="{{ route('admin.portfolios.index') }}" class="text-secondary font-semibold underline hover:text-primary transition-colors ml-1">
                        Tambahkan karya Anda sekarang
                    </a>
                @endauth
            </div>
        @endforelse

    </div>
</section>