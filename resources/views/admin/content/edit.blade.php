@extends('layouts.admin')

@section('title', 'Edit Konten Hero - Admin Aramysta Salon')
@section('page_title', 'Konten')

@section('content')
<div class="max-w-5xl">
    <!-- Header Form -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
        <div>
            <span class="eyebrow">CMS Aramysta Salon</span>
            <h1 class="font-headline-lg text-3xl sm:text-4xl text-primary mt-3">Edit Bagian Hero Portofolio</h1>
        </div>
        <a href="{{ route('portfolio.index') }}" target="_blank" class="btn btn-ghost btn-sm">
            <span class="material-symbols-outlined text-base">visibility</span>
            <span>Lihat Hasil Halaman</span>
        </a>
    </div>

    <!-- Form Utama -->
    <form action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-8">
        @csrf
        @method('PUT')

        <!-- Teks Hero -->
        <section class="panel p-6 md:p-8 flex flex-col gap-5">
            <h2 class="panel-title pb-4 border-b border-outline-variant/30">1. Teks Utama & Tombol (Kolom Kiri)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="flex flex-col gap-1.5">
                    <label class="field-label">Teks Badge Atas</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $content['hero_badge'] ?? 'Portofolio — Arsip Aramysta Salon') }}" class="field">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="field-label">Judul Utama (H1)</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $content['hero_title'] ?? 'Seni Keindahan Rias') }}" class="field">
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="field-label">Deskripsi Singkat</label>
                <textarea name="hero_description" rows="3" class="field">{{ old('hero_description', $content['hero_description'] ?? 'Temukan kurasi tata rias berkelas dari Aramysta Salon untuk pernikahan, selebrasi istimewa, dan publikasi editorial. Diciptakan dengan sentuhan kilau alami kulit yang paripurna serta keahlian artistik eksklusif.') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="flex flex-col gap-1.5">
                    <label class="field-label">Teks Tombol Utama</label>
                    <input type="text" name="hero_cta_primary" value="{{ old('hero_cta_primary', $content['hero_cta_primary'] ?? 'Jelajahi Arsip') }}" class="field">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="field-label">Teks Tombol Kedua</label>
                    <input type="text" name="hero_cta_secondary" value="{{ old('hero_cta_secondary', $content['hero_cta_secondary'] ?? 'Baca Ulasan Klien') }}" class="field">
                </div>
            </div>
        </section>

        <!-- Statistik -->
        <section class="panel p-6 md:p-8 flex flex-col gap-5">
            <h2 class="panel-title pb-4 border-b border-outline-variant/30">2. Strip Statistik (3 Kolom)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stat 1 -->
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 flex flex-col gap-3">
                    <span class="field-label text-secondary">Statistik #1</span>
                    <input type="text" name="stat_1_value" placeholder="Angka/Teks Utama" value="{{ old('stat_1_value', $content['stat_1_value'] ?? '24') }}" class="field">
                    <input type="text" name="stat_1_label" placeholder="Keterangan" value="{{ old('stat_1_label', $content['stat_1_label'] ?? 'Karya Dipublikasikan') }}" class="field">
                </div>
                <!-- Stat 2 -->
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 flex flex-col gap-3">
                    <span class="field-label text-secondary">Statistik #2</span>
                    <input type="text" name="stat_2_value" placeholder="Angka/Teks Utama" value="{{ old('stat_2_value', $content['stat_2_value'] ?? '08') }}" class="field">
                    <input type="text" name="stat_2_label" placeholder="Keterangan" value="{{ old('stat_2_label', $content['stat_2_label'] ?? 'Koleksi Editorial') }}" class="field">
                </div>
                <!-- Stat 3 -->
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 flex flex-col gap-3">
                    <span class="field-label text-secondary">Statistik #3</span>
                    <input type="text" name="stat_3_value" placeholder="Angka/Teks Utama" value="{{ old('stat_3_value', $content['stat_3_value'] ?? 'Malang & Nasional') }}" class="field">
                    <input type="text" name="stat_3_label" placeholder="Keterangan" value="{{ old('stat_3_label', $content['stat_3_label'] ?? 'Layanan Eksklusif') }}" class="field">
                </div>
            </div>
        </section>

        <!-- Foto Hero -->
        <section class="panel p-6 md:p-8 flex flex-col gap-5">
            <h2 class="panel-title pb-4 border-b border-outline-variant/30">3. Kartu Karya Unggulan (Kolom Kanan)</h2>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                <!-- Upload Foto -->
                <div class="md:col-span-4 flex flex-col gap-2">
                    <label class="field-label">Foto Utama (Rasio 4:5)</label>
                    <div class="aspect-[4/5] w-full rounded-2xl overflow-hidden bg-surface-container mb-2">
                        @php
                            $previewImg = !empty($content['hero_image']) 
                                ? asset('storage/' . $content['hero_image']) 
                                : 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1qiMv_hhP_ct7plZ_krd6duwoZxDCLvDhC5D4zERLUsdJ1y1-HFlMJtZCnM9g6pucgzffTbXnHEUkUp0ll-BJXGO7haHU6wU9197GlhGvIutJ_kqBcv-NgPZ6MfeMTQahyzoIiYz5m780nqgyr6JsWq-2DdEvZF-dDIOE311eOVTySLHe5DOAvQXfkV0tAijWibxYnaknugzQgpsKxYHT2msX9AgEWDxGf1kLK9UmZNTZIHR_j8QO_g';
                        @endphp
                        <img src="{{ $previewImg }}" alt="Preview Hero" class="w-full h-full object-cover">
                    </div>
                    <input type="file" name="hero_image" accept="image/*" class="field-file">
                </div>

                <!-- Metadata Kartu -->
                <div class="md:col-span-8 flex flex-col gap-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label class="field-label">Badge Pojok Kanan Atas</label>
                            <input type="text" name="featured_badge" value="{{ old('featured_badge', $content['featured_badge'] ?? 'Edisi Eksklusif Aramysta') }}" class="field">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="field-label">Label Unggulan</label>
                            <input type="text" name="featured_label" value="{{ old('featured_label', $content['featured_label'] ?? 'Karya Unggulan #01') }}" class="field">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label class="field-label">Kategori Riasan</label>
                            <input type="text" name="featured_category" value="{{ old('featured_category', $content['featured_category'] ?? 'Tata Rias Pengantin Couture') }}" class="field">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="field-label">Judul Karya Unggulan</label>
                            <input type="text" name="featured_title" value="{{ old('featured_title', $content['featured_title'] ?? 'Kilau Pengantin Parisienne') }}" class="field">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="field-label">Deskripsi Singkat Karya</label>
                        <input type="text" name="featured_subtitle" value="{{ old('featured_subtitle', $content['featured_subtitle'] ?? 'Tudung kasmir rose, refleksi kilau sampanye mikro & kelembapan abadi.') }}" class="field">
                    </div>
                </div>
            </div>
        </section>

        <!-- Tombol Simpan -->
        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-outlined text-base leading-none">save</span>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>
@endsection