@extends('layouts.app')

@section('content')
    @include('portfolio.partials.hero')

    @include('portfolio.partials.about')

    @include('portfolio.partials.filter-bar')
    @include('portfolio.partials.grid')

    @include('portfolio.partials.services')

    @include('portfolio.partials.testimonials')

    @include('portfolio.partials.contact')
@endsection
