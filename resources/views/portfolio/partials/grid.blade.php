<section class="max-w-7xl mx-auto px-6 lg:px-12 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 items-start" id="portfolioGrid">
        @forelse($portfolios as $item)
            @php
                $imgUrl = str_starts_with($item->image, 'http') 
                    ? $item->image 
                    : asset('storage/' . $item->image);
                $colSpan = $item->is_featured ? 'lg:col-span-8' : 'lg:col-span-4';
                $aspectRatio = $item->is_featured ? 'aspect-[16/10]' : 'aspect-[4/5]';
            @endphp

            <article class="portfolio-card {{ $colSpan }} group relative bg-surface-container-lowest rounded-xl overflow-hidden shadow-lg hover:-translate-y-1" 
                     data-category="{{ $item->category }}" 
                     data-featured="{{ $item->is_featured ? '1' : '0' }}"
                     data-tags="{{ strtolower($item->tags . ' ' . $item->title . ' ' . $item->location_or_event) }}">
                
                <div class="relative {{ $aspectRatio }} w-full overflow-hidden bg-surface-container">
                    <img alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" src="{{ $imgUrl }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent"></div>
                    
                    @if ($item->is_featured)
                        <div class="absolute top-5 left-5 bg-secondary text-on-secondary px-3 py-1 rounded-full font-label-sm text-label-sm uppercase tracking-widest shadow-md">
                            Karya Unggulan
                        </div>
                    @else
                        <div class="absolute bottom-4 left-4 right-4 text-on-primary">
                            <span class="font-subhead-uppercase text-subhead-uppercase text-tertiary-fixed tracking-wider block mb-1">{{ $item->category_label }}</span>
                            <h3 class="font-headline-md text-headline-md text-on-primary mb-1">{{ $item->title }}</h3>
                            <p class="font-body-sm text-body-sm text-surface-container-high/90">{{ $item->location_or_event }}</p>
                        </div>
                    @endif
                </div>

                @if ($item->is_featured)
                    <div class="p-6 md:p-8 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-subhead-uppercase text-subhead-uppercase text-secondary tracking-widest">{{ $item->category_label }}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $item->location_or_event }}</span>
                        </div>
                        <h3 class="font-headline-lg text-headline-lg text-primary mb-3">{{ $item->title }}</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mb-6">{{ $item->description }}</p>
                        @if ($item->tags)
                            <div class="flex flex-wrap items-center gap-2">
                                @foreach(explode(',', $item->tags) as $tag)
                                    <span class="px-2.5 py-1 rounded bg-surface-container text-on-surface-variant font-label-sm text-label-sm">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="p-5 flex items-center justify-between">
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant truncate pr-2">{{ $item->description }}</span>
                        <span class="material-symbols-outlined text-secondary group-hover:translate-x-1 transition-transform shrink-0">arrow_forward</span>
                    </div>
                @endif
            </article>
        @empty
            <div class="lg:col-span-12 text-center py-16 bg-surface-container-low rounded-xl">
                <p class="font-headline-sm text-primary mb-2">Belum ada karya portofolio yang ditambahkan.</p>
                @auth
                    <a href="{{ route('admin.portfolios.index') }}" class="text-secondary underline text-sm">Tambah karya pertama di Halaman Admin</a>
                @endauth
            </div>
        @endforelse
    </div>
</section>