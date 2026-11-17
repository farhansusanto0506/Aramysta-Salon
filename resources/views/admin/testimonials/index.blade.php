@extends('layouts.app')

@section('title', 'Kelola Testimoni - Admin Ramysta Salon')

@section('content')
<div class="max-w-6xl mx-auto px-6 lg:px-12 py-10">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-6 border-b border-outline-variant/40">
        <div>
            <span class="font-subhead-uppercase text-subhead-uppercase text-secondary tracking-widest block mb-1">CMS Ramysta Salon</span>
            <h1 class="font-headline-lg text-headline-lg text-primary">Kelola Testimoni Klien</h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('portfolio.index') }}#testimoni-section" target="_blank" class="px-4 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-xs uppercase tracking-wider hover:bg-secondary transition-colors">Lihat Website</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Tambah Testimoni -->
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm mb-10 flex flex-col gap-5">
        @csrf
        <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">+ Tambah Ulasan Klien</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Nama Klien *</label>
                <input type="text" name="client_name" required placeholder="Contoh: Clarissa Wijaya" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Acara / Keterangan *</label>
                <input type="text" name="event_or_role" required placeholder="Pengantin Resepsi, Malang" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Layanan Riasan</label>
                <select name="category" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
                    <option value="">-- Umum --</option>
                    @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Rating Bintang *</label>
                <select name="rating" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
                    <option value="5" selected>5 Bintang (Sempurna)</option>
                    <option value="4">4 Bintang</option>
                    <option value="3">3 Bintang</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm uppercase text-on-surface-variant">Isi Testimoni *</label>
            <textarea name="quote" rows="3" required placeholder="Tulis pengalaman klien setelah dirias..." class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary"></textarea>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
            <div class="flex flex-col gap-1">
                <label class="font-label-sm uppercase text-on-surface-variant text-[10px]">Foto Profil Klien (Opsional)</label>
                <input type="file" name="avatar" accept="image/*" class="text-xs text-on-surface-variant file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-container file:text-on-primary cursor-pointer">
            </div>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors">
                Simpan Testimoni
            </button>
        </div>
    </form>

    <!-- Daftar Testimoni Tersimpan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($testimonials as $item)
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between border border-outline-variant/20">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-secondary">{{ $item->rating }} / 5 ★</span>
                        <span class="text-[11px] uppercase text-on-surface-variant">{{ $item->category_label ?? 'Umum' }}</span>
                    </div>
                    <p class="text-sm text-primary italic mb-4">“{{ $item->quote }}”</p>
                </div>
                <div class="pt-3 border-t border-surface-container flex items-center justify-between">
                    <div>
                        <h3 class="font-headline-sm text-sm text-primary">{{ $item->client_name }}</h3>
                        <p class="text-xs text-on-surface-variant">{{ $item->event_or_role }}</p>
                    </div>
                    <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-error hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection