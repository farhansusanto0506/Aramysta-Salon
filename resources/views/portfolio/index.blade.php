@extends('layouts.app')

@section('content')
<div class="w-full">
    {{-- Sesi 1: Hero --}}
    @include('portfolio.partials.hero')

    {{-- Sesi 2: Koleksi Karya --}}
    @include('portfolio.partials.filter-bar')
    @include('portfolio.partials.grid')

    {{-- Sesi 3: Layanan --}}
    @include('portfolio.partials.services')

    {{-- Sesi 4: Testimoni (Google Review) --}}
    @include('portfolio.partials.testimonials')

    {{-- Sesi 5: Kontak & Reservasi WhatsApp --}}
    @include('portfolio.partials.contact')
</div>
@endsection