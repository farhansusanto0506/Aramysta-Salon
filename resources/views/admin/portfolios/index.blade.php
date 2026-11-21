@extends('layouts.app')

@section('title', 'Kelola Karya Portofolio - Admin Aramysta Salon')

@section('content')
<div class="max-w-6xl mx-auto px-6 lg:px-12 py-10">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-6 border-b border-outline-variant/40">
        <div>
            <span class="font-subhead-uppercase text-subhead-uppercase text-secondary tracking-widest block mb-1">CMS Aramysta Salon</span>
            <h1 class="font-headline-lg text-headline-lg text-primary">Kelola Karya Portofolio</h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('portfolio.index') }}" target="_blank" class="px-4 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-xs uppercase tracking-wider hover:bg-secondary transition-colors">Lihat Website</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Tambah Karya -->
    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm mb-10 flex flex-col gap-5">
        @csrf
        <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">+ Tambah Karya Baru</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Judul Karya *</label>
                <input type="text" name="title" required placeholder="Contoh: Kilau Pengantin Jawa Modern" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Kategori *</label>
                <select name="category" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
                    @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Lokasi / Acara</label>
                <input type="text" name="location_or_event" placeholder="Contoh: Malang, Jawa Timur" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Deskripsi Singkat</label>
                <input type="text" name="description" placeholder="Sentuhan riasan natural glowing..." class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
            <div class="flex flex-wrap items-center gap-5">
                <!-- Kotak Preview Gambar (Muncul otomatis saat file dipilih) -->
                <div id="createImagePreviewWrap" class="hidden items-center gap-3 p-2 rounded-xl bg-surface-container-low border border-outline-variant/30">
                    <img id="createImagePreview" src="" alt="Preview Karya" class="w-16 h-20 object-cover rounded-lg shadow-sm">
                </div>

                <input type="file" name="image" required accept="image/*" class="text-xs text-on-surface-variant file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-container file:text-on-primary cursor-pointer">
            </div>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors">
                Simpan Karya
            </button>
        </div>
    </form>

    <!-- Daftar Karya Tersimpan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($portfolios as $item)
            <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm flex flex-col">
                <div class="aspect-[4/5] bg-surface-container relative">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @if($item->is_featured)
                        <span class="absolute top-2 left-2 bg-secondary text-white text-[10px] px-2 py-0.5 rounded-full uppercase">Unggulan</span>
                    @endif
                </div>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <span class="text-[11px] uppercase text-secondary font-semibold">{{ $item->category_label }}</span>
                        <h3 class="font-headline-sm text-primary">{{ $item->title }}</h3>
                        @if($item->location_or_event)
                            <p class="text-xs text-on-surface-variant mt-1">{{ $item->location_or_event }}</p>
                        @endif
                        @if($item->description)
                            <p class="text-xs text-on-surface-variant/80 mt-2 line-clamp-2">{{ $item->description }}</p>
                        @endif
                    </div>
                    <div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
                        <a href="{{ route('admin.portfolios.edit', $item) }}" class="text-xs font-semibold text-secondary hover:underline">
                            Edit Karya
                        </a>

                        <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus karya ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-error hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection