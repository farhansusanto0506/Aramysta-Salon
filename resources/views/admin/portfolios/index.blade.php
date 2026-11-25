@extends('layouts.admin')

@section('title', 'Kelola Karya Portofolio - Admin Aramysta Salon')
@section('page_title', 'Portofolio')

@section('content')
    <!-- Header -->
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <span class="eyebrow">CMS Aramysta Salon</span>
            <h1 class="font-headline-lg text-3xl sm:text-4xl text-primary mt-3">Kelola Karya Portofolio</h1>
        </div>
        <span class="badge bg-surface-container text-on-surface-variant">{{ $portfolios->count() }} karya</span>
    </div>

    <!-- Form Tambah Karya -->
    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data"
        class="panel p-6 md:p-8 mb-10 flex flex-col gap-6">
        @csrf
        <div class="flex items-center gap-3 pb-4 border-b border-outline-variant/30">
            <span class="w-9 h-9 rounded-full bg-secondary-fixed/60 text-secondary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-lg">add_photo_alternate</span>
            </span>
            <h2 class="panel-title">Tambah Karya Baru</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="flex flex-col gap-2">
                <label for="createTitle" class="field-label">Judul Karya <span class="text-secondary">*</span></label>
                <input type="text" id="createTitle" name="title" required
                    placeholder="Contoh: Kilau Pengantin Jawa Modern" class="field">
            </div>
            <div class="flex flex-col gap-2">
                <label for="createCategory" class="field-label">Kategori <span class="text-secondary">*</span></label>
                <select id="createCategory" name="category" class="field">
                    @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label for="createLocation" class="field-label">Lokasi / Acara</label>
                <input type="text" id="createLocation" name="location_or_event" placeholder="Contoh: Malang, Jawa Timur"
                    class="field">
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <label for="createDescription" class="field-label">Deskripsi Singkat</label>
            <input type="text" id="createDescription" name="description" placeholder="Sentuhan riasan natural glowing..."
                class="field">
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 pt-5 border-t border-outline-variant/30">
            <div class="flex flex-wrap items-center gap-4">
                <!-- Preview Gambar -->
                <div id="createImagePreviewWrap"
                    class="hidden items-center gap-3 p-1.5 rounded-xl bg-surface-container-low border border-outline-variant/40">
                    <img id="createImagePreview" src="" alt="Preview Karya" class="w-16 h-20 object-cover rounded-lg">
                </div>

                <div class="flex flex-col gap-2">
                    <span class="field-label">Foto Karya <span class="text-secondary">*</span></span>
                    <input type="file" name="image" required accept="image/*" class="field-file">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-outlined text-base leading-none">save</span>
                <span>Simpan Karya</span>
            </button>
        </div>
    </form>

    <!-- Daftar Karya Tersimpan -->
    <div class="flex items-center justify-between gap-3 mb-5">
        <h2 class="panel-title">Karya Tersimpan</h2>
    </div>

    @if ($portfolios->isEmpty())
        <div class="panel p-10 text-center text-sm text-on-surface-variant">
            Belum ada karya yang ditambahkan.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach ($portfolios as $item)
                <div data-reveal class="panel overflow-hidden flex flex-col group">
                    <div class="aspect-[4/5] bg-surface-container relative overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-700 ease-luxe group-hover:scale-105">
                        @if ($item->is_featured)
                            <span class="badge absolute top-3 left-3 bg-secondary text-on-secondary">
                                <span class="material-symbols-outlined text-[12px] leading-none">star</span>
                                Unggulan
                            </span>
                        @endif
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between gap-4">
                        <div>
                            <span class="text-[10px] uppercase tracking-[0.16em] text-secondary font-semibold">{{ $item->category_label }}</span>
                            <h3 class="font-headline-sm text-base text-primary leading-snug mt-1">{{ $item->title }}</h3>
                            @if ($item->location_or_event)
                                <p class="text-xs text-on-surface-variant mt-1 inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] leading-none">location_on</span>
                                    {{ $item->location_or_event }}
                                </p>
                            @endif
                            @if ($item->description)
                                <p class="text-xs text-on-surface-variant/80 mt-2 line-clamp-2">{{ $item->description }}</p>
                            @endif
                        </div>
                        <div class="pt-3 border-t border-outline-variant/30 flex items-center gap-2">
                            <a href="{{ route('admin.portfolios.edit', $item) }}" class="btn btn-ghost btn-sm flex-1">
                                <span class="material-symbols-outlined text-sm leading-none">edit</span>
                                <span>Edit</span>
                            </a>

                            <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Hapus karya ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Karya">
                                    <span class="material-symbols-outlined text-sm leading-none">delete</span>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
