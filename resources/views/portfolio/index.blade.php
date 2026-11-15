@extends('layouts.app')

@section('title', 'Portofolio - Ramysta Salon')

@section('content')
<div class="flex flex-col w-full">
    {{-- 1. Hero Section --}}
    @include('portfolio.partials.hero')

    {{-- Section berikutnya (Filter, Grid Portofolio, Testimoni, Footer) dapat ditambahkan di bawah ini --}}
</div>
@endsection