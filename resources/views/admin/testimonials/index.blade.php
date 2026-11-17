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
           <a href="{{ route('portfolio.index') }}" target="_blank" class="px-4 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-xs uppercase tracking-wider hover:bg-secondary transition-colors">Lihat Website</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Tambah Testimoni -->
    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm mb-10 flex flex-col gap-5">
        @csrf
        <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">+ Tambah Ulasan Klien</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Nama Klien *</label>
                <input type="text" name="client_name" required placeholder="Contoh: Clarissa Wijaya" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Rating Bintang *</label>
                <select name="rating" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary">
                    <option value="5" selected>Bintang 5 (★★★★★)</option>
                    <option value="4">Bintang 4 (★★★★☆)</option>
                    <option value="3">Bintang 3 (★★★☆☆)</option>
                    <option value="2">Bintang 2 (★★☆☆☆)</option>
                    <option value="1">Bintang 1 (★☆☆☆☆)</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-1.5">
            <label class="font-label-sm uppercase text-on-surface-variant">Isi Testimoni *</label>
            <textarea name="quote" rows="3" required placeholder="Tulis pengalaman klien setelah dirias..." class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary"></textarea>
        </div>

        <div class="flex justify-end pt-2">
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
                    <div class="flex items-center gap-0.5 text-secondary mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' {{ $i <= $item->rating ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                    <p class="text-sm text-primary italic mb-4">“{{ $item->quote }}”</p>
                </div>
                <div class="pt-3 border-t border-surface-container flex items-center justify-between">
                    <h3 class="font-headline-sm text-sm text-primary">{{ $item->client_name }}</h3>
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