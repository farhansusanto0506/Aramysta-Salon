@extends('layouts.admin')

@section('title', 'Edit Karya - Admin Aramysta Salon')
@section('page_title', 'Portofolio')

@section('content')
    <div class="max-w-4xl">
        <!-- Header -->
        <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
            <div class="min-w-0">
                <span class="eyebrow">CMS Aramysta Salon</span>
                <h1 class="font-headline-lg text-3xl sm:text-4xl text-primary mt-3 break-words">Edit Karya: {{ $portfolio->title }}</h1>
            </div>
            <a href="{{ route('admin.portfolios.index') }}" class="btn btn-ghost btn-sm">
                <span class="material-symbols-outlined text-sm leading-none">arrow_back</span>
                <span>Kembali</span>
            </a>
        </div>

        <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data"
            class="panel p-6 md:p-8 flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="flex flex-col gap-2">
                    <label for="editTitle" class="field-label">Judul Karya</label>
                    <input type="text" id="editTitle" name="title" required value="{{ old('title', $portfolio->title) }}"
                        class="field">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="editCategory" class="field-label">Kategori</label>
                    <select id="editCategory" name="category" class="field">
                        @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                            <option value="{{ $value }}" @selected($portfolio->category == $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="editLocation" class="field-label">Lokasi / Acara</label>
                    <input type="text" id="editLocation" name="location_or_event"
                        value="{{ old('location_or_event', $portfolio->location_or_event) }}" class="field">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="editDescription" class="field-label">Deskripsi Singkat</label>
                <textarea id="editDescription" name="description" rows="3" class="field">{{ old('description', $portfolio->description) }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}"
                    class="w-24 h-28 object-cover rounded-xl shadow-[var(--shadow-soft)] shrink-0">
                <div class="flex flex-col gap-2">
                    <span class="field-label">Ganti Foto (Opsional)</span>
                    <input type="file" name="image" accept="image/*" class="field-file">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-5 border-t border-outline-variant/30">
                <a href="{{ route('admin.portfolios.index') }}" class="btn btn-ghost">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <span class="material-symbols-outlined text-base leading-none">save</span>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
@endsection
