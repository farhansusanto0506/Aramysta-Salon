@extends('layouts.app')

@section('title', 'Edit Layanan - Aramysta Salon')

@section('content')
<div class="max-w-2xl mx-auto px-6 lg:px-12 py-12">
    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <span class="font-subhead-uppercase text-xs text-secondary tracking-widest block mb-1">Admin Panel</span>
            <h1 class="font-headline-lg text-2xl text-primary">Edit Paket Layanan</h1>
        </div>
        <a href="{{ route('admin.services.index') }}"
           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-surface-container-lowest border border-outline-variant/30 text-primary text-xs font-label-sm uppercase tracking-wider hover:bg-surface-container">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            <span>Kembali</span>
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl p-6 md:p-8 shadow-sm border border-outline-variant/20">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-2">
                <label class="font-label-sm uppercase text-on-surface-variant">Foto Contoh Riasan</label>
                @if ($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                         class="w-32 h-24 rounded-xl object-cover bg-surface-container mb-1">
                @endif
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                       class="text-xs text-on-surface-variant file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-secondary-fixed file:text-on-secondary-fixed file:font-semibold hover:file:bg-secondary hover:file:text-on-primary cursor-pointer">
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-label-sm uppercase text-on-surface-variant">Nama Paket *</label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}" required
                       class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-sm text-primary">
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-label-sm uppercase text-on-surface-variant">Daftar Harga (1 baris = 1 harga) *</label>
                <textarea name="prices" rows="2" required
                          class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-sm text-primary">{{ old('prices', $service->prices) }}</textarea>
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-label-sm uppercase text-on-surface-variant">Rincian Layanan (1 baris = 1 poin) *</label>
                <textarea name="highlights" rows="5" required
                          class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-sm text-primary">{{ old('highlights', $service->highlights) }}</textarea>
            </div>

            <label class="inline-flex items-center gap-2 text-xs text-primary cursor-pointer pt-1">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured)) class="rounded text-secondary focus:ring-secondary">
                <span>Tandai sebagai paket unggulan (Paling Diminati)</span>
            </label>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-surface-container">
                <a href="{{ route('admin.services.index') }}"
                   class="px-5 py-2.5 rounded-xl bg-surface-container text-on-surface-variant text-xs font-label-md uppercase tracking-wider">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors shadow-md cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection