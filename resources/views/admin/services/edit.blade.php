@extends('layouts.admin')

@section('title', 'Edit Layanan - Aramysta Salon')
@section('page_title', 'Layanan')

@section('content')
    <div class="max-w-2xl">
        <!-- Header -->
        <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
            <div>
                <span class="eyebrow">Admin Panel</span>
                <h1 class="font-headline-lg text-3xl sm:text-4xl text-primary mt-3">Edit Paket Layanan</h1>
            </div>
            <a href="{{ route('admin.services.index') }}" class="btn btn-ghost btn-sm">
                <span class="material-symbols-outlined text-sm leading-none">arrow_back</span>
                <span>Kembali</span>
            </a>
        </div>

        <div class="panel p-6 md:p-8">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col gap-5">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-2">
                    <span class="field-label">Foto Contoh Riasan</span>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                class="w-32 h-24 rounded-xl object-cover bg-surface-container shrink-0">
                        @endif
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="field-file">
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="serviceTitle" class="field-label">Nama Paket <span class="text-secondary">*</span></label>
                    <input type="text" id="serviceTitle" name="title" value="{{ old('title', $service->title) }}" required
                        class="field">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="servicePrices" class="field-label">Daftar Harga (1 baris = 1 harga) <span
                            class="text-secondary">*</span></label>
                    <textarea id="servicePrices" name="prices" rows="2" required class="field">{{ old('prices', $service->prices) }}</textarea>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="serviceHighlights" class="field-label">Rincian Layanan (1 baris = 1 poin) <span
                            class="text-secondary">*</span></label>
                    <textarea id="serviceHighlights" name="highlights" rows="5" required class="field">{{ old('highlights', $service->highlights) }}</textarea>
                </div>

                <label class="inline-flex items-center gap-2.5 text-xs text-primary cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured))
                        class="checkbox">
                    <span>Tandai sebagai paket unggulan (Paling Diminati)</span>
                </label>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-outline-variant/30">
                    <a href="{{ route('admin.services.index') }}" class="btn btn-ghost">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined text-base leading-none">save</span>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
