@extends('layouts.app')

@section('title', 'Kelola Layanan - Aramysta Salon')

@section('content')
<div class="max-w-6xl mx-auto px-6 lg:px-12 py-12">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <span class="font-subhead-uppercase text-xs text-secondary tracking-widest block mb-1">Admin Panel</span>
            <h1 class="font-headline-lg text-3xl text-primary">Kelola Paket Layanan</h1>
        </div>
        <a href="{{ url('/') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-surface-container-lowest border border-outline-variant/30 text-primary text-xs font-label-sm uppercase tracking-wider hover:bg-surface-container">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            <span>Kembali ke Halaman Utama</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed text-xs font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-error-container/50 border border-error/30 text-on-error-container text-xs font-medium">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Form Tambah Paket Layanan -->
        <div class="lg:col-span-5 bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/20">
            <h2 class="font-headline-sm text-lg text-primary border-b border-surface-container pb-3 mb-5">
                Tambah Layanan Baru
            </h2>

            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf

                <div class="flex flex-col gap-1">
                    <label class="font-label-sm uppercase text-on-surface-variant">Foto Contoh Riasan</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                           class="text-xs text-on-surface-variant file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-secondary-fixed file:text-on-secondary-fixed file:font-semibold hover:file:bg-secondary hover:file:text-on-primary cursor-pointer">
                </div>

                <div class="flex flex-col gap-1">
                    <label class="font-label-sm uppercase text-on-surface-variant">Nama Paket *</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Paket Reguler (Dewasa)" required
                           class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-sm text-primary">
                </div>

                <div class="flex flex-col gap-1">
                    <label class="font-label-sm uppercase text-on-surface-variant">Daftar Harga (1 baris = 1 harga) *</label>
                    <textarea name="prices" rows="2" placeholder="Start 200rb by owner&#10;150rb by asisten" required
                              class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-sm text-primary">{{ old('prices') }}</textarea>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="font-label-sm uppercase text-on-surface-variant">Rincian Layanan (1 baris = 1 poin) *</label>
                    <textarea name="highlights" rows="4" placeholder="- make-up graduation&#10;- make-up acara spesial (ultah, kondangan, photoshoot, prewed, postwed, bridesmaid, dll)&#10;- pawai, drumband (kecuali maskot, mayoret, gitapati)" required
                              class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-sm text-primary">{{ old('highlights') }}</textarea>
                </div>

                <label class="inline-flex items-center gap-2 text-xs text-primary cursor-pointer pt-1">
                    <input type="checkbox" name="is_featured" value="1" class="rounded text-secondary focus:ring-secondary">
                    <span>Tandai sebagai paket unggulan (Paling Diminati)</span>
                </label>

                <button type="submit"
                        class="mt-2 w-full py-3 rounded-xl bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors shadow-md cursor-pointer">
                    Simpan Layanan
                </button>
            </form>
        </div>

        <!-- Daftar Layanan Tersimpan -->
        <div class="lg:col-span-7 flex flex-col gap-4">
            @forelse ($services as $service)
                <div class="bg-surface-container-lowest rounded-2xl p-5 shadow-xs border border-outline-variant/20 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-start gap-4">
                        @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                 class="w-16 h-16 rounded-xl object-cover shrink-0 bg-surface-container">
                        @endif

                        <div class="space-y-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="font-headline-sm text-base text-primary">{{ $service->title }}</h3>
                                @if ($service->is_featured)
                                    <span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed text-[10px] font-semibold uppercase">Unggulan</span>
                                @endif
                            </div>
                            <p class="text-xs text-secondary font-medium whitespace-pre-line">{{ $service->prices }}</p>
                            <p class="text-xs text-on-surface-variant line-clamp-2 whitespace-pre-line">{{ $service->highlights }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 self-end sm:self-center">
                        <a href="{{ route('admin.services.edit', $service) }}"
                           class="px-3.5 py-2 rounded-lg bg-surface-container-low text-primary hover:bg-secondary hover:text-on-primary text-xs font-medium transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Hapus paket layanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3.5 py-2 rounded-lg bg-error-container/50 text-on-error-container hover:bg-error hover:text-on-error text-xs font-medium transition-colors cursor-pointer">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-surface-container-lowest rounded-2xl p-10 text-center text-sm text-on-surface-variant border border-outline-variant/20">
                    Belum ada paket layanan yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection