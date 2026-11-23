@extends('layouts.app')

@section('content')
    @include('portfolio.partials.hero')

    <div data-scroll-motion="intro">
        @include('portfolio.partials.filter-bar')
        @include('portfolio.partials.grid')
    </div>

    <div data-scroll-motion="intro">
        @include('portfolio.partials.services')
    </div>

    <div data-scroll-motion="intro">
        @include('portfolio.partials.testimonials')
    </div>

    <div data-scroll-motion="outro">
        @include('portfolio.partials.contact')
    </div>
@endsection