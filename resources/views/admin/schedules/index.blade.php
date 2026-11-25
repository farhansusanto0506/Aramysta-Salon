@extends('layouts.admin')

@section('title', 'Kelola Jadwal Terisi - Admin Aramysta Salon')
@section('page_title', 'Jadwal')

@section('content')
    <!-- Header -->
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <span class="eyebrow">CMS Aramysta Salon</span>
            <h1 class="font-headline-lg text-3xl sm:text-4xl text-primary mt-3">Kelola Jadwal Terisi</h1>
        </div>
    </div>

    <!-- Form Tambah Jadwal -->
    <form action="{{ route('admin.schedules.store') }}" method="POST" class="panel p-6 md:p-8 mb-10 flex flex-col gap-6">
        @csrf
        <div class="flex items-center gap-3 pb-4 border-b border-outline-variant/30">
            <span class="w-9 h-9 rounded-full bg-secondary-fixed/60 text-secondary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-lg">event_busy</span>
            </span>
            <h2 class="panel-title">Tandai Tanggal Penuh</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="flex flex-col gap-2">
                <label for="createType" class="field-label">Jenis <span class="text-secondary">*</span></label>
                <select name="type" id="createType" onchange="syncTypeFields('create')" class="field">
                    @foreach (\App\Models\Schedule::TYPES as $value => $label)
                        <option value="{{ $value }}" @selected(old('type', 'full') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-2">
                <label for="createBookingDate" class="field-label">Tanggal <span class="text-secondary">*</span></label>
                <input type="date" id="createBookingDate" name="booking_date" required min="{{ date('Y-m-d') }}" class="field">
            </div>

            <div class="flex flex-col gap-2">
                <label for="createStartTime" class="field-label">Jam Mulai (24 Jam) <span class="text-secondary">*</span></label>
                <select name="start_time" id="createStartTime" class="field">
                    @for ($h = 0; $h < 24; $h++)
                        @foreach (['00'] as $m)
                            @php $t = str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . $m; @endphp
                            <option value="{{ $t }}" @selected($t === '06:00')>{{ $t }} WIB
                            </option>
                        @endforeach
                    @endfor
                </select>
            </div>

            <div class="flex flex-col gap-2">
                <label for="createNote" class="field-label">Keterangan (Opsional)</label>
                <input type="text" id="createNote" name="note" placeholder="Contoh: Pengantin / Full" class="field">
            </div>
        </div>

        <!-- Data Pelanggan -->
        <div id="createCustomerFields" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex flex-col gap-2">
                <label for="createCustomerName" class="field-label">Nama Pelanggan (Opsional)</label>
                <input type="text" id="createCustomerName" name="customer_name" maxlength="100"
                    value="{{ old('customer_name') }}" placeholder="Nama pelanggan" class="field">
            </div>
            <div class="flex flex-col gap-2">
                <label for="createCustomerPhone" class="field-label">Nomor WA (Opsional)</label>
                <input type="tel" id="createCustomerPhone" name="customer_phone" maxlength="20"
                    value="{{ old('customer_phone') }}" placeholder="Contoh: 0812 3456 7890" class="field">
            </div>
        </div>

        <div class="flex justify-end pt-5 border-t border-outline-variant/30">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-outlined text-base leading-none">save</span>
                <span>Simpan Jadwal</span>
            </button>
        </div>
    </form>

    <!-- Daftar Jadwal -->
    <div class="panel overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/30 flex flex-wrap items-center justify-between gap-2">
            <h2 class="panel-title">Daftar Tanggal Sudah Terisi</h2>
            <span class="badge bg-surface-container text-on-surface-variant">{{ $schedules->count() }} tanggal terisi</span>
        </div>

        <div class="divide-y divide-outline-variant/30">
            @forelse ($schedules as $sch)
                @php
                    $isCompleted = str_starts_with((string) $sch->note, '[SELESAI]');
                    $displayNote = trim(preg_replace('/^\[SELESAI\]\s*/', '', (string) $sch->note));
                @endphp
                <div
                    class="data-row px-5 sm:px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4 {{ $isCompleted ? 'opacity-60 bg-surface-container-low/40' : '' }}">
                    <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-surface-container-low border border-outline-variant/30 font-semibold text-xs text-primary {{ $isCompleted ? 'line-through decoration-on-surface-variant/60' : '' }}">
                            <span class="material-symbols-outlined text-[15px] leading-none text-secondary">calendar_today</span>
                            {{ \Carbon\Carbon::parse($sch->booking_date)->translatedFormat('l, d M Y') }}
                        </span>
                        @if ($sch->type === 'blocked')
                            <span class="badge bg-error-container/70 text-on-error-container">
                                <span class="material-symbols-outlined text-[12px] leading-none">block</span>
                                Diblokir
                            </span>
                        @elseif ($sch->start_time)
                            <span class="text-sm font-semibold text-secondary">
                                Mulai {{ $sch->start_time }} WIB
                            </span>
                        @endif
                        @if ($displayNote !== '')
                            <span class="text-xs text-on-surface-variant bg-surface-container px-2.5 py-0.5 rounded-full">
                                {{ $displayNote }}
                            </span>
                        @endif

                        @if ($isCompleted)
                            <span class="badge bg-surface-variant text-on-surface-variant">
                                <span class="material-symbols-outlined text-[12px] leading-none">check_circle</span>
                                Selesai
                            </span>
                        @else
                            <span class="badge bg-secondary-fixed/70 text-on-secondary-fixed">
                                Terjadwal
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-wrap items-center gap-2 md:justify-end shrink-0">
                        @if ($sch->type !== 'blocked')
                            <button type="button"
                                data-date="{{ \Carbon\Carbon::parse($sch->booking_date)->translatedFormat('l, d M Y') }}"
                                data-start-time="{{ $sch->start_time }}"
                                data-note="{{ $displayNote }}"
                                data-customer-name="{{ $sch->customer_name }}"
                                data-customer-phone="{{ $sch->customer_phone }}"
                                onclick="openDetailModal(this)"
                                class="btn btn-ghost btn-sm">
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
                            class="btn btn-ghost btn-sm">
                            <span class="material-symbols-outlined text-sm leading-none">edit</span>
                            <span>Edit</span>
                        </button>

                        <form action="{{ route('admin.schedules.toggle-complete', $sch) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $isCompleted ? 'btn-ghost' : 'btn-soft' }}">
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
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="material-symbols-outlined text-sm leading-none">delete</span>
                                <span>Hapus</span>
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

    <!-- Modal Edit Jadwal -->
    <div id="editScheduleModal"
        class="modal-overlay fixed inset-0 z-50 hidden items-center justify-center bg-primary/30 backdrop-blur-xs p-4"
        onclick="if (event.target === this) closeEditScheduleModal()">
        <div class="modal-panel w-full max-w-lg max-h-[calc(100vh-2rem)] overflow-y-auto rounded-3xl bg-cream border border-white ring-1 ring-primary/10 shadow-[var(--shadow-lift)] p-6 md:p-7">
            <div class="flex items-center justify-between border-b border-outline-variant/40 pb-4 mb-5">
                <div>
                    <span class="eyebrow">Perbarui Data</span>
                    <h3 class="font-headline-sm text-headline-sm text-primary mt-1.5">Edit Jadwal Terisi</h3>
                </div>
                <button type="button" onclick="closeEditScheduleModal()" aria-label="Tutup"
                    class="w-9 h-9 rounded-full bg-white hover:bg-surface-container border border-outline-variant/40 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-lg leading-none">close</span>
                </button>
            </div>

            <form id="editScheduleForm" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-2">
                    <label for="editType" class="field-label">Jenis <span class="text-secondary">*</span></label>
                    <select id="editType" name="type" onchange="syncTypeFields('edit')" class="field bg-white">
                        @foreach (\App\Models\Schedule::TYPES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="editBookingDate" class="field-label">Tanggal <span class="text-secondary">*</span></label>
                        <input type="date" id="editBookingDate" name="booking_date" required class="field bg-white">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="editStartTime" class="field-label">Jam Mulai (24 Jam) <span class="text-secondary">*</span></label>
                        <select id="editStartTime" name="start_time" class="field bg-white">
                            @for ($h = 0; $h < 24; $h++)
                                @php $t = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                                <option value="{{ $t }}">{{ $t }} WIB</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="editNote" class="field-label">Keterangan (Opsional)</label>
                    <input type="text" id="editNote" name="note" placeholder="Contoh: Pengantin / Full" class="field bg-white">
                </div>

                <div id="editCustomerFields" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="editCustomerName" class="field-label">Nama Pelanggan</label>
                        <input type="text" id="editCustomerName" name="customer_name" maxlength="100" class="field bg-white">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="editCustomerPhone" class="field-label">Nomor WA</label>
                        <input type="tel" id="editCustomerPhone" name="customer_phone" maxlength="20" class="field bg-white">
                    </div>
                </div>

                <label
                    class="inline-flex items-center gap-2.5 px-3.5 py-3 rounded-xl bg-white border border-outline-variant/40 text-xs text-primary cursor-pointer transition-colors hover:border-secondary/60">
                    <input type="checkbox" id="editIsCompleted" name="is_completed" value="1" class="checkbox">
                    <span>Tandai jadwal ini sebagai Selesai</span>
                </label>

                <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-outline-variant/40">
                    <button type="button" onclick="closeEditScheduleModal()" class="btn btn-ghost">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined text-sm leading-none">save</span>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Pelanggan -->
    <div id="detailModal"
        class="modal-overlay fixed inset-0 z-50 hidden items-center justify-center bg-primary/30 backdrop-blur-xs p-4"
        onclick="if (event.target === this) closeDetailModal()">
        <div class="modal-panel w-full max-w-md rounded-3xl bg-cream border border-white ring-1 ring-primary/10 shadow-[var(--shadow-lift)] p-6 md:p-7">
            <div class="flex items-center justify-between border-b border-outline-variant/40 pb-4 mb-5">
                <div>
                    <span class="eyebrow">Detail Jadwal</span>
                    <h3 class="font-headline-sm text-headline-sm text-primary mt-1.5" id="detailDate">-</h3>
                </div>
                <button type="button" onclick="closeDetailModal()" aria-label="Tutup"
                    class="w-9 h-9 rounded-full bg-white hover:bg-surface-container border border-outline-variant/40 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-lg leading-none">close</span>
                </button>
            </div>

            <dl class="p-4 rounded-2xl bg-white border border-outline-variant/30 space-y-3 text-sm">
                <div class="flex justify-between gap-3">
                    <dt class="text-on-surface-variant">Jam Mulai</dt>
                    <dd class="font-semibold text-primary text-right" id="detailTime">-</dd>
                </div>
                <div class="flex justify-between gap-3">
                    <dt class="text-on-surface-variant">Keterangan</dt>
                    <dd class="font-semibold text-primary text-right" id="detailNote">-</dd>
                </div>
                <div class="flex justify-between gap-3">
                    <dt class="text-on-surface-variant">Nama Pelanggan</dt>
                    <dd class="font-semibold text-primary text-right" id="detailName">-</dd>
                </div>
                <div class="flex justify-between gap-3">
                    <dt class="text-on-surface-variant">Nomor WA</dt>
                    <dd class="font-semibold text-primary text-right" id="detailPhone">-</dd>
                </div>
            </dl>

            <a id="detailWaLink" href="#" target="_blank" rel="noopener noreferrer"
                class="hidden btn btn-primary mt-5 w-full">
                <span class="material-symbols-outlined text-sm leading-none">chat</span>
                <span>Chat via WhatsApp</span>
            </a>
        </div>
    </div>

    <script>
        // Field sesuai jenis jadwal
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