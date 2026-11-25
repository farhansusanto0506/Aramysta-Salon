@php
    $rawWa = $content['whatsapp_number'] ?? '0853-3147-1243';
    $digitsWa = preg_replace('/\D+/', '', (string) $rawWa);
    if (str_starts_with($digitsWa, '0')) {
        $waInternational = '62' . substr($digitsWa, 1);
    } elseif (str_starts_with($digitsWa, '62')) {
        $waInternational = $digitsWa;
    } else {
        $waInternational = '62' . $digitsWa;
    }
    $waDefaultText = rawurlencode('Halo Aramysta Salon, saya ingin reservasi dan cek jadwal booking.');
@endphp

<footer class="relative w-full bg-surface-container-low border-t border-outline-variant/30 overflow-hidden">
    <div class="container-luxe pt-16 lg:pt-20 pb-8">
        <!-- Ajakan Booking -->
        <div data-reveal
            class="relative mb-14 rounded-[1.75rem] overflow-hidden bg-linear-to-br from-nude via-ivory to-gold-soft/60 border border-gold-soft/70 px-6 py-10 sm:px-12 sm:py-12 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
            <svg class="spin-slow absolute -right-16 -top-16 w-56 h-56 text-gold/30 pointer-events-none" viewBox="0 0 100 100"
                aria-hidden="true">
                <circle cx="50" cy="50" r="48" fill="none" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4" />
                <circle cx="50" cy="50" r="34" fill="none" stroke="currentColor" stroke-width="0.4" />
            </svg>
            <div class="relative max-w-xl">
                <span class="eyebrow mb-4">Siap Tampil Memukau?</span>
                <h2 class="font-headline-lg text-3xl sm:text-[2.5rem] leading-tight text-primary mt-3">
                    Amankan tanggal <span class="italic text-rose-gold">istimewa</span> Anda sekarang
                </h2>
            </div>
            <div class="relative flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <button type="button" data-target="kontak-section" class="nav-scroll-link btn btn-primary">
                    <span class="material-symbols-outlined text-base leading-none">calendar_month</span>
                    <span>Reservasi Jadwal</span>
                </button>
                <a href="https://wa.me/{{ $waInternational }}?text={{ $waDefaultText }}" target="_blank"
                    rel="noopener noreferrer" class="btn btn-ghost">
                    <span class="material-symbols-outlined text-base leading-none">chat</span>
                    <span>Chat WhatsApp</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 pb-12 border-b border-outline-variant/30">

            <!-- Identitas Brand -->
            <div data-reveal class="md:col-span-2 lg:col-span-5 flex flex-col items-start">
                <div class="flex items-center gap-3.5 mb-5">
                    <div
                        class="w-11 h-11 rounded-full bg-primary-container text-gold-soft flex items-center justify-center font-headline-sm text-base tracking-wider ring-1 ring-gold/50 ring-offset-2 ring-offset-surface-container-low">
                        AS
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-base tracking-[0.16em] text-primary uppercase leading-none">
                            Aramysta Salon
                        </span>
                        <span class="font-label-sm text-[9px] tracking-[0.28em] text-gold uppercase mt-1.5">
                            Haute Beauté
                        </span>
                    </div>
                </div>
                <p class="font-body-sm text-sm text-on-surface-variant max-w-sm leading-relaxed mb-5">
                    Layanan tata rias pengantin, wisuda, lamaran, dan acara spesial di Kota Probolinggo. Mengutamakan
                    riasan halus, elegan, dan memancarkan pesona alami Anda.
                </p>
                <div class="inline-flex items-start gap-2 text-xs text-secondary font-medium">
                    <span class="material-symbols-outlined text-base leading-none">location_on</span>
                    <span>Jl. Hos Cokroaminoto No.221, Kota Probolinggo</span>
                </div>
            </div>

            <!-- WhatsApp -->
            <div data-reveal class="lg:col-span-3 flex flex-col gap-4">
                <span class="eyebrow">WhatsApp Reservasi</span>

                <a href="https://wa.me/{{ $waInternational }}?text={{ $waDefaultText }}" target="_blank"
                    rel="noopener noreferrer"
                    class="group p-4 rounded-2xl bg-surface-container-lowest border border-outline-variant/30 hover:border-secondary/60 flex items-center justify-between gap-3.5 transition-colors">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div
                            class="w-10 h-10 rounded-full bg-secondary-fixed/60 group-hover:bg-secondary text-secondary group-hover:text-on-secondary flex items-center justify-center shrink-0 transition-colors">
                            <span class="material-symbols-outlined text-lg">call</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-body-sm text-sm font-semibold text-primary tracking-wide truncate">
                                {{ $rawWa }}
                            </span>
                            <span class="text-[11px] text-on-surface-variant">
                                Admin &amp; Jadwal Booking
                            </span>
                        </div>
                    </div>
                    <span
                        class="material-symbols-outlined text-base text-on-surface-variant group-hover:text-secondary group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-300 shrink-0">
                        north_east
                    </span>
                </a>
            </div>

            <!-- Media Sosial -->
            <div data-reveal class="lg:col-span-4 flex flex-col gap-4">
                <span class="eyebrow">Media Sosial</span>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 xl:grid-cols-2 gap-3">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/Aramysta/" target="_blank" rel="noopener noreferrer"
                        class="group p-3.5 rounded-2xl bg-surface-container-lowest border border-outline-variant/30 hover:border-secondary/60 flex items-center justify-between gap-3 transition-colors">
                        <div class="flex items-center gap-3 min-w-0">
                            <div
                                class="w-9 h-9 rounded-full bg-surface-container-low group-hover:bg-secondary-fixed/60 text-primary group-hover:text-secondary flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-body-sm text-xs font-semibold text-primary truncate">
                                    @Aramysta
                                </span>
                                <span class="text-[11px] text-on-surface-variant">
                                    Instagram
                                </span>
                            </div>
                        </div>
                        <span
                            class="material-symbols-outlined text-base text-on-surface-variant group-hover:text-secondary group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-300 shrink-0">
                            north_east
                        </span>
                    </a>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/Aramystariaspengantinprobolinggo" target="_blank"
                        rel="noopener noreferrer"
                        class="group p-3.5 rounded-2xl bg-surface-container-lowest border border-outline-variant/30 hover:border-secondary/60 flex items-center justify-between gap-3 transition-colors">
                        <div class="flex items-center gap-3 min-w-0">
                            <div
                                class="w-9 h-9 rounded-full bg-surface-container-low group-hover:bg-secondary-fixed/60 text-primary group-hover:text-secondary flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                </svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-body-sm text-xs font-semibold text-primary truncate">
                                    Amalia Ramista
                                </span>
                                <span class="text-[11px] text-on-surface-variant">
                                    Facebook
                                </span>
                            </div>
                        </div>
                        <span
                            class="material-symbols-outlined text-base text-on-surface-variant group-hover:text-secondary group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-300 shrink-0">
                            north_east
                        </span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Baris Hak Cipta -->
        <div
            class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-on-surface-variant text-center sm:text-left">
            <p>&copy; {{ date('Y') }} Aramysta Salon Probolinggo. Seluruh hak cipta dilindungi.</p>
            <p class="text-[11px] tracking-[0.18em] uppercase text-secondary/80 font-medium">Bridal &amp; Event Makeup
                Artist</p>
        </div>
    </div>
</footer>
