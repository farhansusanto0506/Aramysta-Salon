@extends('layouts.app')

@section('title', 'Kelola Jadwal Terisi - Admin Aramysta Salon')

@section('content')
    <div class="max-w-5xl mx-auto px-6 lg:px-12 py-10">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-6 border-b border-outline-variant/40">
            <div>
                <span class="font-subhead-uppercase text-subhead-uppercase text-secondary tracking-widest block mb-1">CMS
                    Aramysta Salon</span>
                <h1 class="font-headline-lg text-headline-lg text-primary">Kelola Jadwal Terisi</h1>
            </div>
            <a href="{{ route('portfolio.index') }}"
                class="px-4 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-xs uppercase tracking-wider hover:bg-secondary transition-colors">
                Lihat Website
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-6 p-4 rounded-xl bg-secondary-fixed/50 border border-secondary/30 text-on-secondary-fixed text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-error-container/50 border border-error/30 text-on-error-container text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Tambah Jadwal Terisi -->
        <form action="{{ route('admin.schedules.store') }}" method="POST"
            class="p-6 md:p-8 rounded-xl bg-surface-container-lowest shadow-sm mb-10 flex flex-col gap-5">
            @csrf
            <h2 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">+ Tandai
                Tanggal Penuh</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase text-on-surface-variant">Jenis *</label>
                    <select name="type" id="createType" onchange="syncTypeFields('create')"
                        class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                        @foreach (\App\Models\Schedule::TYPES as $value => $label)
                            <option value="{{ $value }}" @selected(old('type', 'full') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase text-on-surface-variant">Tanggal *</label>
                    <input type="date" name="booking_date" required min="{{ date('Y-m-d') }}"
                        class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase text-on-surface-variant">Jam Mulai (24 Jam) *</label>
                    <select name="start_time" id="createStartTime"
                        class="rounded-lg disabled:opacity-50 bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                        @for ($h = 0; $h < 24; $h++)
                            @foreach (['00'] as $m)
                                @php $t = str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . $m; @endphp
                                <option value="{{ $t }}" @selected($t === '06:00')>{{ $t }} WIB
                                </option>
                            @endforeach
                        @endfor
                    </select>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase text-on-surface-variant">Keterangan (Opsional)</label>
                    <input type="text" name="note" placeholder="Contoh: Pengantin / Full"
                        class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>
            </div>

            <!-- Data Pelanggan (hanya untuk tanggal penuh) -->
            <div id="createCustomerFields" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase text-on-surface-variant">Nama Pelanggan (Opsional)</label>
                    <input type="text" name="customer_name" maxlength="100" value="{{ old('customer_name') }}"
                        placeholder="Nama pelanggan"
                        class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-sm uppercase text-on-surface-variant">Nomor WA (Opsional)</label>
                    <input type="tel" name="customer_phone" maxlength="20" value="{{ old('customer_phone') }}"
                        placeholder="Contoh: 0812 3456 7890"
                        class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors cursor-pointer">
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
                    @php
                        $isCompleted = str_starts_with((string) $sch->note, '[SELESAI]');
                        $displayNote = trim(preg_replace('/^\[SELESAI\]\s*/', '', (string) $sch->note));
                    @endphp
                    <div
                        class="px-6 py-4 flex flex-wrap items-center justify-between gap-4 transition-opacity {{ $isCompleted ? 'opacity-55 bg-surface-container-low/40' : '' }}">
                        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                            <span
                                class="px-3 py-1 rounded-lg bg-surface-container-low font-semibold text-xs text-primary {{ $isCompleted ? 'line-through decoration-on-surface-variant/60' : '' }}">
                                {{ \Carbon\Carbon::parse($sch->booking_date)->translatedFormat('l, d M Y') }}
                            </span>
                            @if ($sch->type === 'blocked')
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container/60 text-on-error-container font-label-sm text-[10px] uppercase tracking-wider font-semibold">
                                    <span class="material-symbols-outlined text-[12px] leading-none">block</span>
                                    Diblokir
                                </span>
                            @elseif ($sch->start_time)
                                <span class="text-sm font-semibold text-secondary">
                                    Mulai {{ $sch->start_time }} WIB
                                </span>
                            @endif
                            @if ($displayNote !== '')
                                <span
                                    class="text-xs text-on-surface-variant bg-surface-container px-2.5 py-0.5 rounded-full">
                                    {{ $displayNote }}
                                </span>
                            @endif

                            @if ($isCompleted)
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-surface-variant text-on-surface-variant font-label-sm text-[10px] uppercase tracking-wider font-semibold">
                                    <span class="material-symbols-outlined text-[12px] leading-none">check_circle</span>
                                    Selesai
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-fixed/60 text-on-secondary-fixed font-label-sm text-[10px] uppercase tracking-wider font-semibold">
                                    Terjadwal
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2.5 sm:gap-3">
                            @if ($sch->type !== 'blocked')
                                <button type="button"
                                    data-date="{{ \Carbon\Carbon::parse($sch->booking_date)->translatedFormat('l, d M Y') }}"
                                    data-start-time="{{ $sch->start_time }}"
                                    data-note="{{ $displayNote }}"
                                    data-customer-name="{{ $sch->customer_name }}"
                                    data-customer-phone="{{ $sch->customer_phone }}"
                                    onclick="openDetailModal(this)"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container border border-outline-variant/40 text-xs font-medium text-primary transition-colors cursor-pointer whitespace-nowrap">
                                    <span class="material-symbols-outlined text-sm leading-none">person</span>
                                    <span>Detail</span>
                                </button>
                            @endif

                            <button type="button"
                                data-id="{{ $sch->id }}"
                                data-customer-name="{{ $sch->customer_name }}"
                                data-customer-phone="{{ $sch->customer_phone }}"
                                data-booking-date="{{ \Carbon\Carbon::parse($sch->booking_date)->format('Y-m-d') }}"
                                data-start-time="{{ substr((string) $sch->start_time, 0, 5) }}"
                                data-note="{{ $displayNote }}"
                                data-type="{{ $sch->type }}"
                                data-is-completed="{{ $isCompleted ? '1' : '0' }}"
                                onclick="openEditScheduleModalFromBtn(this)"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container border border-outline-variant/40 text-xs font-medium text-primary transition-colors cursor-pointer whitespace-nowrap">
                                <span class="material-symbols-outlined text-sm leading-none">edit</span>
                                <span>Edit</span>
                            </button>

                            <form action="{{ route('admin.schedules.toggle-complete', $sch) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors cursor-pointer {{ $isCompleted ? 'bg-surface-container-high text-on-surface-variant hover:text-primary' : 'bg-secondary-fixed/60 text-on-secondary-fixed hover:bg-secondary hover:text-on-secondary' }}">
                                    <span class="material-symbols-outlined text-sm leading-none">
                                        {{ $isCompleted ? 'undo' : 'check_circle' }}
                                    </span>
                                    <span>{{ $isCompleted ? 'Batalkan' : 'Tandai Selesai' }}</span>
                                </button>
                            </form>

                            <form action="{{ route('admin.schedules.destroy', $sch) }}" method="POST"
                                onsubmit="return confirm('Hapus jadwal tanggal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-xs text-error font-medium hover:underline cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center text-sm text-on-surface-variant">
                        Belum ada tanggal terisi yang dicatat. Semua tanggal masih tersedia untuk klien.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Edit Jadwal Terisi -->
    <div id="editScheduleModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-primary/20 backdrop-blur-xs p-4"
        onclick="if (event.target === this) closeEditScheduleModal()">
        <div
            class="w-full max-w-lg rounded-3xl bg-[#FAF7F2]/95 backdrop-blur-2xl backdrop-saturate-150 border border-white/90 ring-1 ring-primary/10 shadow-[0_20px_48px_rgba(44,34,30,0.14),inset_0_1px_0_rgba(255,255,255,0.96)] p-6 md:p-7">
            <div class="flex items-center justify-between border-b border-outline-variant/30 pb-3.5 mb-5">
                <div>
                    <span class="font-subhead-uppercase text-[10px] text-secondary tracking-widest block">Perbarui Data</span>
                    <h3 class="font-headline-sm text-headline-sm text-primary">Edit Jadwal Terisi</h3>
                </div>
                <button type="button" onclick="closeEditScheduleModal()"
                    class="w-9 h-9 rounded-[9999px] bg-white/85 hover:bg-white border border-white shadow-2xs flex items-center justify-center text-on-surface-variant hover:text-primary transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-lg leading-none">close</span>
                </button>
            </div>

            <form id="editScheduleForm" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-1.5">
                    <label for="editType" class="font-label-sm uppercase text-on-surface-variant">Jenis *</label>
                    <select id="editType" name="type" onchange="syncTypeFields('edit')"
                        class="rounded-xl bg-white/95 border border-outline-variant/45 shadow-2xs focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 text-primary transition-all">
                        @foreach (\App\Models\Schedule::TYPES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label for="editBookingDate" class="font-label-sm uppercase text-on-surface-variant">Tanggal *</label>
                        <input type="date" id="editBookingDate" name="booking_date" required
                            class="rounded-xl bg-white/95 border border-outline-variant/45 shadow-2xs focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 text-primary transition-all">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="editStartTime" class="font-label-sm uppercase text-on-surface-variant">Jam Mulai (24 Jam) *</label>
                        <select id="editStartTime" name="start_time"
                            class="disabled:opacity-50 rounded-xl bg-white/95 border border-outline-variant/45 shadow-2xs focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 text-primary transition-all">
                            @for ($h = 0; $h < 24; $h++)
                                @php $t = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                                <option value="{{ $t }}">{{ $t }} WIB</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="editNote" class="font-label-sm uppercase text-on-surface-variant">Keterangan (Opsional)</label>
                    <input type="text" id="editNote" name="note" placeholder="Contoh: Pengantin / Full"
                        class="rounded-xl bg-white/95 border border-outline-variant/45 shadow-2xs focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 text-primary transition-all">
                </div>

                <div id="editCustomerFields" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label for="editCustomerName" class="font-label-sm uppercase text-on-surface-variant">Nama Pelanggan</label>
                        <input type="text" id="editCustomerName" name="customer_name" maxlength="100"
                            class="rounded-xl bg-white/95 border border-outline-variant/45 shadow-2xs focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 text-primary transition-all">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label for="editCustomerPhone" class="font-label-sm uppercase text-on-surface-variant">Nomor WA</label>
                        <input type="tel" id="editCustomerPhone" name="customer_phone" maxlength="20"
                            class="rounded-xl bg-white/95 border border-outline-variant/45 shadow-2xs focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 text-primary transition-all">
                    </div>
                </div>

                <label
                    class="inline-flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-white/80 border border-white shadow-2xs text-xs text-primary cursor-pointer pt-1 transition-colors hover:bg-white">
                    <input type="checkbox" id="editIsCompleted" name="is_completed" value="1"
                        class="rounded border-outline-variant text-secondary focus:ring-secondary">
                    <span>Tandai jadwal ini sebagai Selesai</span>
                </label>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-outline-variant/30">
                    <button type="button" onclick="closeEditScheduleModal()"
                        class="px-4 py-2.5 rounded-[9999px] bg-white/85 hover:bg-white border border-white shadow-2xs text-xs font-medium text-on-surface-variant hover:text-primary transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-[9999px] bg-primary-container hover:bg-secondary text-on-primary font-label-md uppercase text-xs tracking-wider transition-all cursor-pointer shadow-md hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-sm leading-none">save</span>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Pelanggan -->
    <div id="detailModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-primary/20 backdrop-blur-xs p-4"
        onclick="if (event.target === this) closeDetailModal()">
        <div
            class="w-full max-w-md rounded-3xl bg-[#FAF7F2]/95 backdrop-blur-2xl backdrop-saturate-150 border border-white/90 ring-1 ring-primary/10 shadow-[0_20px_48px_rgba(44,34,30,0.14),inset_0_1px_0_rgba(255,255,255,0.96)] p-6 md:p-7">
            <div class="flex items-center justify-between border-b border-outline-variant/30 pb-3.5 mb-5">
                <div>
                    <span class="font-subhead-uppercase text-[10px] text-secondary tracking-widest block">Detail Jadwal</span>
                    <h3 class="font-headline-sm text-headline-sm text-primary" id="detailDate">-</h3>
                </div>
                <button type="button" onclick="closeDetailModal()"
                    class="w-9 h-9 rounded-[9999px] bg-white/85 hover:bg-white border border-white shadow-2xs flex items-center justify-center text-on-surface-variant hover:text-primary transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-lg leading-none">close</span>
                </button>
            </div>

            <div class="p-4 rounded-xl bg-white/80 border border-white space-y-2.5 text-sm">
                <div class="flex justify-between gap-3">
                    <span class="text-on-surface-variant">Jam Mulai</span>
                    <span class="font-semibold text-primary text-right" id="detailTime">-</span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-on-surface-variant">Keterangan</span>
                    <span class="font-semibold text-primary text-right" id="detailNote">-</span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-on-surface-variant">Nama Pelanggan</span>
                    <span class="font-semibold text-primary text-right" id="detailName">-</span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-on-surface-variant">Nomor WA</span>
                    <span class="font-semibold text-primary text-right" id="detailPhone">-</span>
                </div>
            </div>

            <a id="detailWaLink" href="#" target="_blank" rel="noopener noreferrer"
                class="hidden mt-5 w-full items-center justify-center gap-2 px-5 py-3 rounded-[9999px] bg-primary-container hover:bg-secondary text-on-primary font-label-md uppercase text-xs tracking-wider transition-all shadow-md">
                <span class="material-symbols-outlined text-sm leading-none">chat</span>
                <span>Chat via WhatsApp</span>
            </a>
        </div>
    </div>

    <script>
        // Tanggal "Diblokir" tidak butuh jam mulai & data pelanggan.
        function syncTypeFields(prefix) {
            const isBlocked = document.getElementById(prefix + 'Type').value === 'blocked';
            document.getElementById(prefix + 'StartTime').disabled = isBlocked;
            document.getElementById(prefix + 'CustomerFields').classList.toggle('hidden', isBlocked);
        }
        document.addEventListener('DOMContentLoaded', () => syncTypeFields('create'));

        function openDetailModal(btn) {
            const d = btn.dataset;
            document.getElementById('detailDate').textContent = d.date || '-';
            document.getElementById('detailTime').textContent = d.startTime ? `${d.startTime} WIB` : '-';
            document.getElementById('detailNote').textContent = d.note || '-';
            document.getElementById('detailName').textContent = d.customerName || 'Belum diisi';
            document.getElementById('detailPhone').textContent = d.customerPhone ? `+${d.customerPhone}` : 'Belum diisi';

            const waLink = document.getElementById('detailWaLink');
            waLink.href = d.customerPhone ? `https://wa.me/${d.customerPhone}` : '#';
            waLink.classList.toggle('hidden', !d.customerPhone);
            waLink.classList.toggle('inline-flex', !!d.customerPhone);

            const modal = document.getElementById('detailModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openEditScheduleModalFromBtn(btn) {
            const modal = document.getElementById('editScheduleModal');
            const form = document.getElementById('editScheduleForm');

            const id = btn.dataset.id;
            form.action = `{{ url('/admin/schedules') }}/${id}`;
            document.getElementById('editBookingDate').value = btn.dataset.bookingDate ?? '';
            document.getElementById('editStartTime').value = btn.dataset.startTime || '06:00';
            document.getElementById('editType').value = btn.dataset.type || 'full';
            syncTypeFields('edit');
            document.getElementById('editNote').value = btn.dataset.note ?? '';
            document.getElementById('editCustomerName').value = btn.dataset.customerName ?? '';
            document.getElementById('editCustomerPhone').value = btn.dataset.customerPhone ?? '';
            document.getElementById('editIsCompleted').checked = btn.dataset.isCompleted === '1';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditScheduleModal() {
            const modal = document.getElementById('editScheduleModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection