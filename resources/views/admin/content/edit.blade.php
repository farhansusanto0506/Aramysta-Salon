@extends('layouts.app')

@section('title', 'Edit Konten Hero - Admin Aramysta Salon')

@section('content')
<div class="max-w-5xl mx-auto px-6 lg:px-12 py-10">
    <!-- Header Form -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-6 border-b border-outline-variant/40">
        <div>
            <span class="font-subhead-uppercase text-subhead-uppercase text-secondary tracking-widest block mb-1">CMS Aramysta Salon</span>
            <h1 class="font-headline-lg text-headline-lg text-primary">Edit Bagian Hero Portofolio</h1>
        </div>
        <a href="{{ route('portfolio.index') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-lowest text-primary font-label-md text-xs uppercase tracking-wider shadow-sm hover:bg-surface-container-high transition-colors">
            <span class="material-symbols-outlined text-base">visibility</span>
            <span>Lihat Hasil Halaman</span>
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="mb-8 p-4 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined text-secondary">check_circle</span>
            <span class="font-label-md">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Utama -->
    <form action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-8">
        @csrf
        @method('PUT')

        <!-- Teks Hero -->
        <section class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-5">
            <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">1. Teks Utama & Tombol (Kolom Kiri)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Teks Badge Atas</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $content['hero_badge'] ?? 'Portofolio — Arsip Aramysta Salon') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Judul Utama (H1)</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $content['hero_title'] ?? 'Seni Keindahan Rias') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Deskripsi Singkat</label>
                <textarea name="hero_description" rows="3" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">{{ old('hero_description', $content['hero_description'] ?? 'Temukan kurasi tata rias berkelas dari Aramysta Salon untuk pernikahan, selebrasi istimewa, dan publikasi editorial. Diciptakan dengan sentuhan kilau alami kulit yang paripurna serta keahlian artistik eksklusif.') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Teks Tombol Utama</label>
                    <input type="text" name="hero_cta_primary" value="{{ old('hero_cta_primary', $content['hero_cta_primary'] ?? 'Jelajahi Arsip') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Teks Tombol Kedua</label>
                    <input type="text" name="hero_cta_secondary" value="{{ old('hero_cta_secondary', $content['hero_cta_secondary'] ?? 'Baca Ulasan Klien') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>
            </div>
        </section>

        <!-- Statistik -->
        <section class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-5">
            <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">2. Strip Statistik (3 Kolom)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stat 1 -->
                <div class="p-4 rounded-lg bg-surface-container-low flex flex-col gap-3">
                    <span class="font-label-sm text-secondary uppercase">Statistik #1</span>
                    <input type="text" name="stat_1_value" placeholder="Angka/Teks Utama" value="{{ old('stat_1_value', $content['stat_1_value'] ?? '24') }}" class="rounded-lg bg-surface-container-lowest border-transparent focus:border-secondary focus:ring-secondary text-primary text-sm">
                    <input type="text" name="stat_1_label" placeholder="Keterangan" value="{{ old('stat_1_label', $content['stat_1_label'] ?? 'Karya Dipublikasikan') }}" class="rounded-lg bg-surface-container-lowest border-transparent focus:border-secondary focus:ring-secondary text-primary text-sm">
                </div>
                <!-- Stat 2 -->
                <div class="p-4 rounded-lg bg-surface-container-low flex flex-col gap-3">
                    <span class="font-label-sm text-secondary uppercase">Statistik #2</span>
                    <input type="text" name="stat_2_value" placeholder="Angka/Teks Utama" value="{{ old('stat_2_value', $content['stat_2_value'] ?? '08') }}" class="rounded-lg bg-surface-container-lowest border-transparent focus:border-secondary focus:ring-secondary text-primary text-sm">
                    <input type="text" name="stat_2_label" placeholder="Keterangan" value="{{ old('stat_2_label', $content['stat_2_label'] ?? 'Koleksi Editorial') }}" class="rounded-lg bg-surface-container-lowest border-transparent focus:border-secondary focus:ring-secondary text-primary text-sm">
                </div>
                <!-- Stat 3 -->
                <div class="p-4 rounded-lg bg-surface-container-low flex flex-col gap-3">
                    <span class="font-label-sm text-secondary uppercase">Statistik #3</span>
                    <input type="text" name="stat_3_value" placeholder="Angka/Teks Utama" value="{{ old('stat_3_value', $content['stat_3_value'] ?? 'Malang & Nasional') }}" class="rounded-lg bg-surface-container-lowest border-transparent focus:border-secondary focus:ring-secondary text-primary text-sm">
                    <input type="text" name="stat_3_label" placeholder="Keterangan" value="{{ old('stat_3_label', $content['stat_3_label'] ?? 'Layanan Eksklusif') }}" class="rounded-lg bg-surface-container-lowest border-transparent focus:border-secondary focus:ring-secondary text-primary text-sm">
                </div>
            </div>
        </section>

        <!-- Foto Hero -->
        <section class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-5">
            <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">3. Kartu Karya Unggulan (Kolom Kanan)</h2>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                <!-- Upload Foto -->
                <div class="md:col-span-4 flex flex-col gap-2">
                    <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Foto Utama (Rasio 4:5)</label>
                    <div class="aspect-[4/5] w-full rounded-lg overflow-hidden bg-surface-container mb-2">
                        @php
                            $previewImg = !empty($content['hero_image']) 
                                ? asset('storage/' . $content['hero_image']) 
                                : 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1qiMv_hhP_ct7plZ_krd6duwoZxDCLvDhC5D4zERLUsdJ1y1-HFlMJtZCnM9g6pucgzffTbXnHEUkUp0ll-BJXGO7haHU6wU9197GlhGvIutJ_kqBcv-NgPZ6MfeMTQahyzoIiYz5m780nqgyr6JsWq-2DdEvZF-dDIOE311eOVTySLHe5DOAvQXfkV0tAijWibxYnaknugzQgpsKxYHT2msX9AgEWDxGf1kLK9UmZNTZIHR_j8QO_g';
                        @endphp
                        <img src="{{ $previewImg }}" alt="Preview Hero" class="w-full h-full object-cover">
                    </div>
                    <input type="file" name="hero_image" accept="image/*" class="text-xs text-on-surface-variant file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-primary-container file:text-on-primary hover:file:bg-secondary cursor-pointer">
                </div>

                <!-- Metadata Kartu -->
                <div class="md:col-span-8 flex flex-col gap-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Badge Pojok Kanan Atas</label>
                            <input type="text" name="featured_badge" value="{{ old('featured_badge', $content['featured_badge'] ?? 'Edisi Eksklusif Aramysta') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Label Unggulan</label>
                            <input type="text" name="featured_label" value="{{ old('featured_label', $content['featured_label'] ?? 'Karya Unggulan #01') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Kategori Riasan</label>
                            <input type="text" name="featured_category" value="{{ old('featured_category', $content['featured_category'] ?? 'Tata Rias Pengantin Couture') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Judul Karya Unggulan</label>
                            <input type="text" name="featured_title" value="{{ old('featured_title', $content['featured_title'] ?? 'Kilau Pengantin Parisienne') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-sm uppercase tracking-wider text-on-surface-variant">Deskripsi Singkat Karya</label>
                        <input type="text" name="featured_subtitle" value="{{ old('featured_subtitle', $content['featured_subtitle'] ?? 'Tudung kasmir rose, refleksi kilau sampanye mikro & kelembapan abadi.') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                    </div>
                </div>
            </div>
        </section>

        <!-- Tombol Simpan -->
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-lg bg-primary-container text-on-primary font-label-md uppercase tracking-widest hover:bg-secondary transition-colors shadow-md">
                <span class="material-symbols-outlined text-lg">save</span>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>
@endsection