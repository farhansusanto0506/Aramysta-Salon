@extends('layouts.app')

@section('title', 'Portofolio - Ramysta Salon')

@section('content')
<div class="flex flex-col w-full">
    {{-- Sesi 1: Portofolio (Hero) --}}
    @include('portfolio.partials.hero')

    {{-- Sesi 2: Koleksi (Filter + Grid Karya) --}}
    <div id="koleksi-section" class="scroll-mt-20">
        @include('portfolio.partials.filter-bar')
        @include('portfolio.partials.grid')
    </div>

    {{-- Sesi 3: Testimoni --}}
    @include('portfolio.partials.testimonials')
</div>
@endsection