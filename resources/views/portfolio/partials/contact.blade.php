<section id="kontak-section"
    class="scroll-mt-20 relative w-full bg-cream border-t border-outline-variant/30 section-y overflow-hidden">
    <!-- Ambient Glow -->
    <div data-parallax="0.06"
        class="absolute -top-32 left-0 w-96 h-96 bg-secondary-fixed/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container-luxe relative z-10">
        <!-- Section Header -->
        <div data-reveal class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="section-num">05</span>
                    <span class="eyebrow">Kontak &amp; Reservasi</span>

                    @auth
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-primary btn-sm">
                            <span class="material-symbols-outlined text-sm leading-none">event_busy</span>
                            <span>Kelola Jadwal</span>
                        </a>
                    @endauth
                </div>
                <h2 class="font-headline-lg text-3xl sm:text-headline-lg text-primary leading-tight">
                    Jadwalkan Sesi <span class="italic text-rose-gold">Rias</span> Anda
                </h2>
            </div>
            <p class="font-body-md text-on-surface-variant max-w-md">
                Pilih tanggal untuk mengecek ketersediaan slot perias, lalu susun pesan reservasi Anda secara otomatis
                ke WhatsApp Aramysta Salon.
            </p>
        </div>

        <!-- Form & Preview -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start" id="waBookingWrapper"
            data-wa-number="6285331471243" data-booked-schedules='@json($bookedSchedules ?? [])'>

            <!-- Form Reservasi -->
            <div data-reveal class="lg:col-span-7 panel p-6 sm:p-8 flex flex-col gap-6">
                <div class="flex items-center gap-3 pb-4 border-b border-outline-variant/30">
                    <span
                        class="w-9 h-9 rounded-full bg-secondary-fixed/60 text-secondary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-lg">edit_note</span>
                    </span>
                    <h3 class="font-headline-sm text-headline-sm text-primary">
                        Detail Reservasi Klien
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col gap-2">
                        <label for="waName" class="field-label">Nama Lengkap <span class="text-secondary">*</span></label>
                        <input type="text" id="waName" placeholder="Isi nama Anda" autocomplete="name" class="field">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="waService" class="field-label">Jenis Layanan Riasan <span
                                class="text-secondary">*</span></label>
                        <select id="waService" class="field">
                            @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                                <option value="{{ $label }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Pilihan Paket -->
                <div id="waPackageContainer" class="hidden flex-col gap-2">
                    <div class="flex flex-wrap items-center justify-between gap-1">
                        <label for="waPackage" class="field-label">Jenis Paket Rias <span
                                class="text-secondary">*</span></label>
                        <span id="waPackageHint" class="field-hint"></span>
                    </div>
                    <select id="waPackage" class="field">
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col gap-2">
                        <label for="waDate" class="field-label">Tanggal Booking <span class="text-secondary">*</span></label>
                        <div class="relative">
                            <input type="text" id="waDate" placeholder="Klik untuk pilih tanggal..." readonly
                                class="field pr-11 cursor-pointer">
                            <span
                                class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-lg text-secondary pointer-events-none">calendar_month</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="waHour" class="field-label">Jam Sesi Rias (24 Jam) <span
                                class="text-secondary">*</span></label>
                        <div class="grid grid-cols-2 gap-2.5">
                            <select id="waHour" aria-label="Jam" class="field pl-3 pr-8">
                                @for ($h = 0; $h < 24; $h++)
                                    @php $hourStr = str_pad($h, 2, '0', STR_PAD_LEFT); @endphp
                                    <option value="{{ $hourStr }}" @selected($hourStr === '08')>{{ $hourStr }} WIB</option>
                                @endfor
                            </select>

                            <select id="waMinute" aria-label="Menit" class="field pl-3 pr-8">
                                @for ($m = 0; $m < 60; $m += 5)
                                    @php $minStr = str_pad($m, 2, '0', STR_PAD_LEFT); @endphp
                                    <option value="{{ $minStr }}">Menit :{{ $minStr }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Status Ketersediaan -->
                <div id="scheduleStatusBox" class="hidden p-4 rounded-xl border text-xs" aria-live="polite"></div>

                <div class="flex flex-col gap-2">
                    <div class="flex flex-wrap items-center justify-between gap-1">
                        <label for="waLocation" class="field-label">Alamat Kunjungan Perias (Opsional)</label>
                        <span class="field-hint">Kosongkan jika datang ke Studio Aramysta Salon</span>
                    </div>
                    <input type="text" id="waLocation"
                        placeholder="Isi alamat lengkap hanya jika perias datang ke lokasi Anda" class="field">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="waNotes" class="field-label">Catatan Tambahan (Opsional)</label>
                    <textarea id="waNotes" rows="3"
                        placeholder="Contoh: Hijab styling, jumlah orang yang dirias, atau nuansa makeup..."
                        class="field resize-y"></textarea>
                </div>
            </div>

            <!-- Preview WhatsApp -->
            <div data-reveal class="lg:col-span-5 lg:sticky lg:top-28 panel p-6 sm:p-8 flex flex-col gap-5">
                <div class="flex items-center justify-between gap-3 pb-4 border-b border-outline-variant/30">
                    <h3 class="font-headline-sm text-headline-sm text-primary">Preview Pesan WhatsApp</h3>
                    <span class="badge bg-secondary-fixed/60 text-on-secondary-fixed">
                        <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
                        Otomatis
                    </span>
                </div>

                <!-- Ringkasan -->
                <dl class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 space-y-2.5 text-xs">
                    <div class="flex justify-between gap-3">
                        <dt class="text-on-surface-variant shrink-0">Klien</dt>
                        <dd id="summaryName" class="font-semibold text-primary text-right">-</dd>
                    </div>
                    <div class="flex justify-between gap-3">
                        <dt class="text-on-surface-variant shrink-0">Layanan</dt>
                        <dd id="summaryService" class="font-semibold text-primary text-right">-</dd>
                    </div>
                    <div id="summaryPackageRow" class="hidden justify-between gap-3">
                        <dt class="text-on-surface-variant shrink-0">Paket</dt>
                        <dd id="summaryPackage" class="font-semibold text-secondary text-right">-</dd>
                    </div>
                    <div class="flex justify-between gap-3">
                        <dt class="text-on-surface-variant shrink-0">Jadwal</dt>
                        <dd id="summarySchedule" class="font-semibold text-secondary text-right">Pilih tanggal terlebih
                            dahulu</dd>
                    </div>
                    <div class="flex justify-between gap-3">
                        <dt class="text-on-surface-variant shrink-0">Lokasi</dt>
                        <dd id="summaryLocation" class="font-semibold text-primary text-right">Datang langsung ke Studio
                            Aramysta Salon</dd>
                    </div>
                </dl>

                <!-- Isi Pesan -->
                <div class="flex flex-col gap-2">
                    <span class="field-label">Isi Pesan yang Akan Dikirim</span>
                    <div class="max-h-64 overflow-y-auto p-4 rounded-2xl bg-[#F3EFEA] border border-outline-variant/30 text-xs text-primary font-mono whitespace-pre-line leading-relaxed"
                        id="waMessagePreview"></div>
                </div>

                <!-- Pesan Error -->
                <p id="waErrorMsg" role="alert"
                    class="hidden alert alert-error text-xs">
                    - Mohon isi Nama Lengkap dan pilih Tanggal Booking terlebih dahulu.
                </p>

                <!-- Tombol Kirim -->
                <button type="button" id="sendWaBtn" class="btn btn-primary w-full py-4 whitespace-normal">
                    <span class="material-symbols-outlined text-lg leading-none">chat</span>
                    <span>Kirim Reservasi via WhatsApp</span>
                    <span class="material-symbols-outlined text-sm leading-none">open_in_new</span>
                </button>
            </div>

        </div>
    </div>
</section>
