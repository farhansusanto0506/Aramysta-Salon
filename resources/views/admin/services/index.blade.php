@extends('layouts.admin')

@section('title', 'Kelola Layanan - Aramysta Salon')
@section('page_title', 'Layanan')

@section('content')
    <!-- Header -->
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <span class="eyebrow">Admin Panel</span>
            <h1 class="font-headline-lg text-3xl sm:text-4xl text-primary mt-3">Kelola Paket Layanan</h1>
        </div>
        <span class="badge bg-surface-container text-on-surface-variant">{{ $services->count() }} paket</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Form Tambah Paket Layanan -->
        <div class="lg:col-span-5 lg:sticky lg:top-28 panel p-6">
            <div class="flex items-center gap-3 pb-4 mb-5 border-b border-outline-variant/30">
                <span class="w-9 h-9 rounded-full bg-secondary-fixed/60 text-secondary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-lg">add</span>
                </span>
                <h2 class="panel-title">Tambah Layanan Baru</h2>
            </div>

            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-2">
                    <span class="field-label">Foto Contoh Riasan</span>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="field-file">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="serviceTitle" class="field-label">Nama Paket <span class="text-secondary">*</span></label>
                    <input type="text" id="serviceTitle" name="title" value="{{ old('title') }}"
                        placeholder="Paket Reguler (Dewasa)" required class="field">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="servicePrices" class="field-label">Daftar Harga (1 baris = 1 harga) <span
                            class="text-secondary">*</span></label>
                    <textarea id="servicePrices" name="prices" rows="2" placeholder="Start 200rb by owner&#10;150rb by asisten"
                        required class="field">{{ old('prices') }}</textarea>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="serviceHighlights" class="field-label">Rincian Layanan (1 baris = 1 poin) <span
                            class="text-secondary">*</span></label>
                    <textarea id="serviceHighlights" name="highlights" rows="4"
                        placeholder="- make-up graduation&#10;- make-up acara spesial (ultah, kondangan, photoshoot, prewed, postwed, bridesmaid, dll)&#10;- pawai, drumband (kecuali maskot, mayoret, gitapati)"
                        required class="field">{{ old('highlights') }}</textarea>
                </div>

                <label class="inline-flex items-center gap-2.5 text-xs text-primary cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" class="checkbox">
                    <span>Tandai sebagai paket unggulan (Paling Diminati)</span>
                </label>

                <button type="submit" class="btn btn-primary w-full mt-1">
                    <span class="material-symbols-outlined text-base leading-none">save</span>
                    <span>Simpan Layanan</span>
                </button>
            </form>
        </div>

        <!-- Daftar Layanan Tersimpan -->
        <div class="lg:col-span-7 panel overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant/30 flex items-center justify-between">
                <h2 class="panel-title">Paket Tersimpan</h2>
            </div>

            <div class="divide-y divide-outline-variant/30">
                @forelse ($services as $service)
                    <div class="data-row px-5 sm:px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-4 min-w-0">
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                    class="w-16 h-16 rounded-xl object-cover shrink-0 bg-surface-container">
                            @else
                                <span class="w-16 h-16 rounded-xl bg-surface-container text-on-surface-variant/50 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined">image</span>
                                </span>
                            @endif

                            <div class="space-y-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-headline-sm text-base text-primary">{{ $service->title }}</h3>
                                    @if ($service->is_featured)
                                        <span class="badge bg-secondary-fixed text-on-secondary-fixed">Unggulan</span>
                                    @endif
                                </div>
                                <p class="text-xs text-secondary font-medium whitespace-pre-line">{{ $service->prices }}</p>
                                <p class="text-xs text-on-surface-variant line-clamp-2 whitespace-pre-line">{{ $service->highlights }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0 self-end sm:self-center">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-ghost btn-sm">
                                <span class="material-symbols-outlined text-sm leading-none">edit</span>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                onsubmit="return confirm('Hapus paket layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <span class="material-symbols-outlined text-sm leading-none">delete</span>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center text-sm text-on-surface-variant">
                        Belum ada paket layanan yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
