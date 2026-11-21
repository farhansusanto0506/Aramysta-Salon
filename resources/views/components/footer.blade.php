@php
    $rawWa = $content['whatsapp_number'] ?? '0812-3456-7890';
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

<footer class="w-full bg-surface-container-low border-t border-outline-variant/25 mt-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start pb-12 border-b border-outline-variant/20">
            
            <!-- Kolom Kiri: Identitas Brand -->
            <div class="lg:col-span-5 flex flex-col items-start">
                <div class="flex items-center gap-3.5 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary flex items-center justify-center font-headline-sm text-base tracking-wider shadow-xs">
                        RS
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-base tracking-[0.14em] text-primary uppercase leading-none">
                            Aramysta Salon
                        </span>
                        <span class="font-label-sm text-[9px] tracking-[0.25em] text-secondary uppercase mt-1">
                            Haute Beauté
                        </span>
                    </div>
                </div>
                <p class="font-body-sm text-xs text-on-surface-variant max-w-sm leading-relaxed mb-4">
                    Layanan tata rias pengantin, wisuda, lamaran, dan acara spesial di Kota Probolinggo. Mengutamakan riasan halus, elegan, dan memancarkan pesona alami Anda.
                </p>
                <div class="inline-flex items-center gap-1.5 text-[11px] text-secondary font-medium">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    <span>Jl. Hos Cokroaminoto No.221, Kota Probolinggo</span>
                </div>
            </div>

            <!-- Kolom Kanan: Kartu Kontak & Media Sosial -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Grup 1: WhatsApp Reservasi (Dapat Diklik) -->
                <div class="flex flex-col gap-3">
                    <span class="font-label-sm text-[11px] uppercase tracking-[0.18em] text-secondary font-semibold">
                        WhatsApp Reservasi
                    </span>

                    <a href="https://wa.me/{{ $waInternational }}?text={{ $waDefaultText }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="p-4 rounded-xl bg-surface-container-lowest border border-outline-variant/25 hover:border-secondary shadow-2xs hover:shadow-sm flex items-center justify-between gap-3.5 transition-all group cursor-pointer">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-secondary-fixed/50 group-hover:bg-secondary text-secondary group-hover:text-on-secondary flex items-center justify-center shrink-0 transition-colors">
                                <span class="material-symbols-outlined text-lg">call</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-body-sm text-sm font-semibold text-primary group-hover:text-secondary tracking-wide transition-colors truncate">
                                    {{ $rawWa }}
                                </span>
                                <span class="text-[11px] text-on-surface-variant">
                                    Admin &amp; Jadwal Booking
                                </span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-base text-on-surface-variant group-hover:text-secondary group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform shrink-0">
                            north_east
                        </span>
                    </a>
                </div>

                <!-- Grup 2: Media Sosial (Dapat Diklik) -->
                <div class="flex flex-col gap-3">
                    <span class="font-label-sm text-[11px] uppercase tracking-[0.18em] text-secondary font-semibold">
                        Media Sosial
                    </span>

                    <div class="flex flex-col gap-2.5">
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/Aramysta/"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="p-3.5 rounded-xl bg-surface-container-lowest border border-outline-variant/25 hover:border-secondary shadow-2xs hover:shadow-sm flex items-center justify-between gap-3 transition-all group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-lg bg-surface-container-low group-hover:bg-secondary-fixed/50 text-primary group-hover:text-secondary flex items-center justify-center transition-colors shrink-0">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-body-sm text-xs font-semibold text-primary group-hover:text-secondary transition-colors truncate">
                                        @Aramysta
                                    </span>
                                    <span class="text-[11px] text-on-surface-variant">
                                        Instagram
                                    </span>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-base text-on-surface-variant group-hover:text-secondary group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform shrink-0">
                                north_east
                            </span>
                        </a>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/Aramystariaspengantinprobolinggo"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="p-3.5 rounded-xl bg-surface-container-lowest border border-outline-variant/25 hover:border-secondary shadow-2xs hover:shadow-sm flex items-center justify-between gap-3 transition-all group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-lg bg-surface-container-low group-hover:bg-secondary-fixed/50 text-primary group-hover:text-secondary flex items-center justify-center transition-colors shrink-0">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                    </svg>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-body-sm text-xs font-semibold text-primary group-hover:text-secondary transition-colors truncate">
                                        Amalia Ramista
                                    </span>
                                    <span class="text-[11px] text-on-surface-variant">
                                        Facebook
                                    </span>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-base text-on-surface-variant group-hover:text-secondary group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform shrink-0">
                                north_east
                            </span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <!-- Baris Hak Cipta -->
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-on-surface-variant">
            <p>&copy; {{ date('Y') }} Aramysta Salon Probolinggo. Seluruh hak cipta dilindungi.</p>
            <p class="text-[11px] tracking-wider uppercase text-secondary/80 font-medium">Bridal &amp; Event Makeup Artist</p>
        </div>
    </div>
</footer>