@extends('layouts.app')

@section('title', 'Portofolio - Ramysta Salon')

@section('content')
<div class="flex flex-col w-full">
    {{-- 1. Hero Section --}}
    @include('portfolio.partials.hero')

    {{-- 2. Filter & Search Bar --}}
    @include('portfolio.partials.filter-bar')

    {{-- 3. Editorial Photography Grid --}}
    @include('portfolio.partials.grid')
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.portfolio-filter-btn');
    const cards = document.querySelectorAll('.portfolio-card');
    const searchInput = document.getElementById('portfolioSearch');
    let currentCategory = 'all';

    function applyFilterAndSearch() {
        const query = (searchInput?.value || '').toLowerCase().trim();
        cards.forEach(card => {
            const category = card.getAttribute('data-category');
            const tags = card.getAttribute('data-tags') || '';
            const matchesCategory = currentCategory === 'all' || category === currentCategory;
            const matchesQuery = query === '' || tags.includes(query);
            card.classList.toggle('hidden', !(matchesCategory && matchesQuery));
        });
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => {
                b.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-md');
                b.classList.add('bg-surface-container-lowest', 'text-on-surface');
            });
            btn.classList.add('bg-primary-container', 'text-on-primary', 'shadow-md');
            btn.classList.remove('bg-surface-container-lowest', 'text-on-surface');
            currentCategory = btn.getAttribute('data-category');
            applyFilterAndSearch();
        });
    });

    searchInput?.addEventListener('input', applyFilterAndSearch);

    // View Switcher (Masonry vs Grid Seragam)
    const viewMasonryBtn = document.getElementById('viewMasonryBtn');
    const viewGridBtn = document.getElementById('viewGridBtn');

    viewGridBtn?.addEventListener('click', () => {
        viewGridBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        viewMasonryBtn.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        cards.forEach(card => {
            card.classList.remove('lg:col-span-8');
            card.classList.add('lg:col-span-4');
        });
    });

    viewMasonryBtn?.addEventListener('click', () => {
        viewMasonryBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        viewGridBtn.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        cards.forEach(card => {
            if (card.getAttribute('data-featured') === '1') {
                card.classList.remove('lg:col-span-4');
                card.classList.add('lg:col-span-8');
            }
        });
    });
});
</script>
@endpush