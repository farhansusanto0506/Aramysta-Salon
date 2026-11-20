<section id="kontak-section" class="scroll-mt-20 relative w-full bg-[#FAF7F2] border-t border-outline-variant/30 py-20 overflow-hidden">
    <!-- Ambient Glow -->
    <div class="absolute -top-32 left-0 w-96 h-96 bg-secondary-fixed/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest text-secondary shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                        <span class="font-subhead-uppercase text-subhead-uppercase tracking-[0.2em]">Kontak &amp; Reservasi</span>
                    </div>

                    @auth
                        <a href="{{ route('admin.schedules.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-primary-container text-on-primary font-label-sm uppercase tracking-wider text-[11px] hover:bg-secondary transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-sm leading-none">event_busy</span>
                            <span>Kelola Jadwal</span>
                        </a>
                    @endauth
                </div>
                <h2 class="font-headline-lg text-headline-lg text-primary leading-tight">
                    Jadwalkan Sesi Rias Anda
                </h2>
            </div>
            <p class="font-body-md text-on-surface-variant max-w-md">
                Pilih tanggal untuk mengecek ketersediaan slot perias, lalu susun pesan reservasi Anda secara otomatis ke WhatsApp Ramysta Salon.
            </p>
        </div>

        <!-- Form & Live Preview Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" 
             id="waBookingWrapper" 
             data-wa-number="6285158773837"
             data-booked-schedules='@json($bookedSchedules ?? [])'>
            
            <!-- Kolom Kiri: Form Input Booking -->
            <div class="lg:col-span-7 bg-surface-container-lowest rounded-2xl p-6 md:p-8 shadow-sm border border-outline-variant/20 flex flex-col gap-5">
                <h3 class="font-headline-sm text-headline-sm text-primary border-b border-surface-container pb-3">
                    Detail Reservasi Klien
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col gap-1.5">
                        <label for="waName" class="font-label-sm uppercase text-on-surface-variant">Nama Lengkap *</label>
                        <input type="text" id="waName" placeholder="Isi nama Anda" 
                               class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="waService" class="font-label-sm uppercase text-on-surface-variant">Jenis Layanan Riasan *</label>
                        <select id="waService" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                            @foreach (\App\Models\Portfolio::CATEGORIES as $value => $label)
                                <option value="{{ $label }}">{{ $label }}</option>
                            @endforeach
                            <option value="Wisuda / Lamaran">Wisuda / Lamaran</option>
                            <option value="Konsultasi & Trial Makeup">Konsultasi &amp; Trial Makeup</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col gap-1.5">
                        <label for="waDate" class="font-label-sm uppercase text-on-surface-variant">Tanggal Booking *</label>
                        <input type="text" id="waDate" placeholder="Klik untuk pilih tanggal..." readonly
                               class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary cursor-pointer">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="waHour" class="font-label-sm uppercase text-on-surface-variant">Jam Sesi Rias (24 Jam) *</label>
                        <div class="grid grid-cols-2 gap-2.5">
                            <select id="waHour" aria-label="Jam" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                                @for ($h = 0; $h < 24; $h++)
                                    @php $hourStr = str_pad($h, 2, '0', STR_PAD_LEFT); @endphp
                                    <option value="{{ $hourStr }}" @selected($hourStr === '08')>{{ $hourStr }} WIB</option>
                                @endfor
                            </select>

                            <select id="waMinute" aria-label="Menit" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                                @for ($m = 0; $m < 60; $m += 5)
                                    @php $minStr = str_pad($m, 2, '0', STR_PAD_LEFT); @endphp
                                    <option value="{{ $minStr }}">Menit :{{ $minStr }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Panel Status Ketersediaan Jadwal pada Tanggal Terpilih -->
                <div id="scheduleStatusBox" class="hidden p-4 rounded-xl border text-xs"></div>

                <div class="flex flex-col gap-1.5">
                    <div class="flex flex-wrap items-center justify-between gap-1">
                        <label for="waLocation" class="font-label-sm uppercase text-on-surface-variant">Alamat Kunjungan Perias (Opsional)</label>
                        <span class="text-[11px] text-secondary font-medium">Kosongkan jika datang ke Studio Ramysta Salon</span>
                    </div>
                    <input type="text" id="waLocation" placeholder="Isi alamat lengkap hanya jika perias datang ke lokasi Anda" 
                           class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="waNotes" class="font-label-sm uppercase text-on-surface-variant">Catatan Tambahan (Opsional)</label>
                    <textarea id="waNotes" rows="2" placeholder="Contoh: Hijab styling, jumlah orang yang dirias, atau nuansa makeup..." 
                              class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary"></textarea>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan & Live Preview Pesan WhatsApp -->
            <div class="lg:col-span-5 bg-surface-container-lowest rounded-2xl p-6 md:p-8 shadow-md border border-outline-variant/30 flex flex-col gap-5">
                <div class="flex items-center justify-between border-b border-surface-container pb-3">
                    <h3 class="font-headline-sm text-headline-sm text-primary">Preview Pesan WhatsApp</h3>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-secondary-fixed/50 text-on-secondary-fixed font-label-sm text-[10px] uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
                        Otomatis
                    </span>
                </div>

                <!-- Ringkasan Jadwal Terpilih -->
                <div class="p-4 rounded-xl bg-surface-container-low/80 border border-outline-variant/20 space-y-2 text-xs">
                    <div class="flex justify-between gap-2">
                        <span class="text-on-surface-variant">Klien:</span>
                        <span id="summaryName" class="font-semibold text-primary text-right">-</span>
                    </div>
                    <div class="flex justify-between gap-2">
                        <span class="text-on-surface-variant">Layanan:</span>
                        <span id="summaryService" class="font-semibold text-primary text-right">-</span>
                    </div>
                    <div class="flex justify-between gap-2">
                        <span class="text-on-surface-variant">Jadwal:</span>
                        <span id="summarySchedule" class="font-semibold text-secondary text-right">Pilih tanggal terlebih dahulu</span>
                    </div>
                    <div class="flex justify-between gap-2">
                        <span class="text-on-surface-variant">Lokasi:</span>
                        <span id="summaryLocation" class="font-semibold text-primary text-right">Datang langsung ke Studio Ramysta Salon</span>
                    </div>
                </div>

                <!-- Teks Preview Pesan WA -->
                <div class="flex flex-col gap-1.5">
                    <span class="font-label-sm text-[10px] uppercase tracking-wider text-on-surface-variant">Isi Pesan yang Akan Dikirim:</span>
                    <div class="p-4 rounded-xl bg-[#F3EFEA] border border-outline-variant/30 text-xs text-primary font-mono whitespace-pre-line leading-relaxed" id="waMessagePreview"></div>
                </div>

                <!-- Peringatan Validasi Ringan -->
                <p id="waErrorMsg" class="hidden text-xs text-error font-medium">
                    * Mohon isi Nama Lengkap dan pilih Tanggal Booking terlebih dahulu.
                </p>

                <!-- Tombol Kirim ke WhatsApp -->
                <button type="button" id="sendWaBtn" 
                        class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-4 rounded-xl bg-primary-container text-on-primary font-label-md uppercase text-xs tracking-widest hover:bg-secondary transition-colors shadow-md cursor-pointer">
                    <span class="material-symbols-outlined text-lg leading-none">chat</span>
                    <span>Kirim Reservasi via WhatsApp</span>
                    <span class="material-symbols-outlined text-sm leading-none">open_in_new</span>
                </button>
            </div>

        </div>
    </div>
</section>