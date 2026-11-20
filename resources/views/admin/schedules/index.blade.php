@extends('layouts.app')

@section('title', 'Kelola Jadwal Terisi - Admin Aramysta Salon')

@section('content')
<div class="max-w-5xl mx-auto px-6 lg:px-12 py-10">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-6 border-b border-outline-variant/40">
        <div>
            <span class="font-subhead-uppercase text-subhead-uppercase text-secondary tracking-widest block mb-1">CMS Aramysta Salon</span>
            <h1 class="font-headline-lg text-headline-lg text-primary">Kelola Jadwal Terisi</h1>
        </div>
        <a href="{{ route('portfolio.index') }}" class="px-4 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-xs uppercase tracking-wider hover:bg-secondary transition-colors">
            Lihat Website
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-error-container/50 border border-error/30 text-on-error-container text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Form Tambah Jadwal Terisi -->
    <form action="{{ route('admin.schedules.store') }}" method="POST" class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm mb-10 flex flex-col gap-5">
        @csrf
        <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">+ Tandai Tanggal Penuh</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Tanggal *</label>
                <input type="date" name="booking_date" required min="{{ date('Y-m-d') }}" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Jam Mulai (24 Jam) *</label>
                <select name="start_time" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                    @for ($h = 0; $h < 24; $h++)
                        @foreach (['00'] as $m)
                            @php $t = str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . $m; @endphp
                            <option value="{{ $t }}" @selected($t === '06:00')>{{ $t }} WIB</option>
                        @endforeach
                    @endfor
                </select>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-label-sm uppercase text-on-surface-variant">Keterangan (Opsional)</label>
                <input type="text" name="note" placeholder="Contoh: Pengantin / Full" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
            </div>
        </div>

        <div class="flex justify-end pt-1">
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors">
                Simpan Jadwal
            </button>
        </div>
    </form>

    <!-- Daftar Jadwal Mendatang -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/20 overflow-hidden">
        <div class="px-6 py-4 border-b border-surface-container flex items-center justify-between">
            <h3 class="font-headline-sm text-base text-primary">Daftar Tanggal Sudah Terisi</h3>
            <span class="text-xs text-on-surface-variant">{{ $schedules->count() }} tanggal terisi</span>
        </div>

        <div class="divide-y divide-surface-container">
            @forelse ($schedules as $sch)
                <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-4">
                        <span class="px-3 py-1 rounded-lg bg-surface-container-low font-semibold text-xs text-primary">
                            {{ \Carbon\Carbon::parse($sch->booking_date)->translatedFormat('l, d M Y') }}
                        </span>
                        <span class="text-sm font-semibold text-secondary">
                            Mulai {{ $sch->start_time }} WIB (Full Day)
                        </span>
                        @if ($sch->note)
                            <span class="text-xs text-on-surface-variant bg-surface-container px-2.5 py-0.5 rounded-full">
                                {{ $sch->note }}
                            </span>
                        @endif
                    </div>

                    <form action="{{ route('admin.schedules.destroy', $sch) }}" method="POST" onsubmit="return confirm('Hapus jadwal tanggal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-error font-medium hover:underline">Hapus</button>
                    </form>
                </div>
            @empty
                <div class="p-10 text-center text-sm text-on-surface-variant">
                    Belum ada tanggal terisi yang dicatat. Semua tanggal masih tersedia untuk klien.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection