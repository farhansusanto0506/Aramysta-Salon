@extends('layouts.app')

@section('title', 'Edit Karya - Admin Aramysta Salon')

@section('content')
<div class="max-w-4xl mx-auto px-6 lg:px-12 py-10">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-6 border-b border-outline-variant/40">
        <div>
            <span class="font-subhead-uppercase text-subhead-uppercase text-secondary tracking-widest block mb-1">CMS Aramysta Salon</span>
            <h1 class="font-headline-lg text-headline-lg text-primary">Edit Karya: {{ $portfolio->title }}</h1>
        </div>
        <a href="{{ route('admin.portfolios.index') }}" class="px-4 py-2.5 rounded-lg bg-surface-container text-primary font-label-md text-xs uppercase tracking-wider hover:bg-surface-container-high">
            &larr; Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-error-container text-on-error-container text-xs space-y-1">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Judul Karya</label>
                <input type="text" name="title" required value="{{ old('title', $portfolio->title) }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Kategori</label>
                <select name="category" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                    @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                        <option value="{{ $value }}" @selected($portfolio->category == $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Lokasi / Acara</label>
                <input type="text" name="location_or_event" value="{{ old('location_or_event', $portfolio->location_or_event) }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Deskripsi Singkat</label>
                <textarea name="description" rows="2" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">{{ old('description', $portfolio->description) }}</textarea>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-4 rounded-xl bg-surface-container-low">
            <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-24 h-28 object-cover rounded-lg shadow-sm shrink-0">
            <div class="flex flex-col gap-2">
                <input type="file" name="image" accept="image/*" class="text-xs text-on-surface-variant file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-container file:text-on-primary cursor-pointer">
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 pt-2 border-t border-surface-container">
            <label class="inline-flex items-center gap-2 text-sm text-primary cursor-pointer">
                <input type="checkbox" name="is_featured" {{ old('is_featured', $portfolio->is_featured) ? 'checked' : '' }} class="rounded text-secondary focus:ring-secondary">
                <span>Jadikan Kartu Lebar (Unggulan)</span>
            </label>

            <button type="submit" class="px-8 py-3 rounded-lg bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection