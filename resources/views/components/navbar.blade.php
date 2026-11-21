<header class="sticky top-0 z-40 w-full px-3 sm:px-6 lg:px-10 pt-3 sm:pt-4 pointer-events-none">
    <div class="max-w-7xl mx-auto flex flex-col gap-2">

        <!-- Baris Utama: Pill Kiri (Brand + Navigasi Sejajar) & Pill Kanan (Aksi / Admin) -->
        <div class="flex flex-wrap md:flex-nowrap items-center justify-between gap-2.5 sm:gap-3">

            <!-- PILL 1: Brand + Navigasi Utama (Rata Tengah & Seragam) -->
            <div class="pointer-events-auto flex-1 min-w-0 rounded-2xl md:rounded-[9999px] bg-[#FAF7F2]/40 backdrop-blur-2xl backdrop-saturate-150 border border-white/65 ring-1 ring-primary/5 shadow-[0_8px_32px_rgba(44,34,30,0.07),inset_0_1px_0_rgba(255,255,255,0.88)] px-4 sm:px-6 py-2.5 flex items-center justify-between gap-4 lg:gap-8 transition-all duration-300">

                <!-- Brand / Logo -->
                <button type="button" data-target="portofolio-section" class="nav-scroll-link flex items-center gap-2.5 sm:gap-3 group shrink-0 text-left cursor-pointer">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-[9999px] bg-primary-container/95 text-on-primary flex items-center justify-center font-headline-sm text-sm tracking-wider shadow-sm group-hover:bg-secondary transition-colors shrink-0">
                        AS
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-xs sm:text-sm lg:text-base tracking-[0.14em] text-primary uppercase leading-none whitespace-nowrap">
                            Aramysta Salon
                        </span>
                        <span class="font-label-sm text-[8px] sm:text-[9px] tracking-[0.24em] text-secondary uppercase mt-1 whitespace-nowrap">
                            Haute Beauté
                        </span>
                    </div>
                </button>

                <!-- Menu Navigasi Desktop (Satu Baris Rata Tengah) -->
                <nav class="hidden md:flex items-center gap-6 lg:gap-8">
                    <button type="button" data-target="portofolio-section"
                            class="nav-scroll-link inline-flex items-center h-8 font-label-sm uppercase tracking-[0.16em] text-xs text-primary font-semibold border-b-2 border-secondary transition-colors cursor-pointer whitespace-nowrap">
                        Portofolio
                    </button>

                    <button type="button" data-target="koleksi-section"
                            class="nav-scroll-link inline-flex items-center h-8 font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer whitespace-nowrap">
                        Koleksi
                    </button>

                    <button type="button" data-target="layanan-section"
                            class="nav-scroll-link inline-flex items-center h-8 font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer whitespace-nowrap">
                        Layanan
                    </button>

                    <button type="button" data-target="testimoni-section"
                            class="nav-scroll-link inline-flex items-center h-8 font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer whitespace-nowrap">
                        Ulasan
                    </button>

                    <button type="button" data-target="kontak-section"
                            class="nav-scroll-link inline-flex items-center h-8 font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer whitespace-nowrap">
                        Kontak
                    </button>
                </nav>
            </div>

            <!-- PILL 2: Status Admin / Tombol Reservasi & Login -->
            <div class="pointer-events-auto rounded-2xl md:rounded-[9999px] bg-[#FAF7F2]/40 backdrop-blur-2xl backdrop-saturate-150 border border-white/65 ring-1 ring-primary/5 shadow-[0_8px_32px_rgba(44,34,30,0.07),inset_0_1px_0_rgba(255,255,255,0.88)] px-3 sm:px-4 py-2 flex items-center justify-end gap-1.5 sm:gap-2 shrink-0 transition-all duration-300">
                @auth
                    <span class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1.5 rounded-[9999px] bg-secondary-fixed/55 border border-white/60 text-on-secondary-fixed font-label-sm text-[9px] sm:text-[10px] uppercase tracking-wider font-semibold whitespace-nowrap backdrop-blur-md">
                        <span class="w-1.5 h-1.5 rounded-[9999px] bg-secondary animate-pulse"></span>
                        <span>Mode Admin</span>
                    </span>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-3 sm:px-3.5 py-2 rounded-[9999px] bg-white/45 hover:bg-error-container/70 border border-white/65 text-primary hover:text-on-error-container font-label-sm uppercase tracking-wider text-[10px] sm:text-[11px] transition-all cursor-pointer whitespace-nowrap shadow-2xs">
                            <span class="material-symbols-outlined text-sm leading-none">logout</span>
                            <span>Keluar</span>
                        </button>
                    </form>
                @else
                    <button type="button" data-target="kontak-section"
                            class="nav-scroll-link cta-reservasi-btn inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-2 rounded-[9999px] bg-primary-container text-white hover:bg-secondary font-label-sm uppercase tracking-wider text-[10px] sm:text-[11px] transition-all shadow-sm cursor-pointer whitespace-nowrap">
                        <span class="material-symbols-outlined text-sm leading-none">calendar_month</span>
                        <span>Reservasi</span>
                    </button>

                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-1.5 px-3 sm:px-3.5 py-2 rounded-[9999px] bg-white/45 hover:bg-white/80 text-primary border border-white/65 font-label-sm uppercase tracking-wider text-[10px] sm:text-[11px] transition-all whitespace-nowrap shadow-2xs">
                        <span class="material-symbols-outlined text-sm leading-none">login</span>
                        <span>Login</span>
                    </a>
                @endauth
            </div>

        </div>

        <!-- PILL ADMIN SWITCHER (Muncul Rapi di Bawah Saat Mode Admin) -->
        @auth
            <div class="pointer-events-auto self-center md:self-end rounded-2xl md:rounded-[9999px] bg-[#FAF7F2]/45 backdrop-blur-2xl backdrop-saturate-150 border border-white/65 ring-1 ring-primary/5 shadow-[0_6px_24px_rgba(44,34,30,0.06),inset_0_1px_0_rgba(255,255,255,0.85)] px-2 py-1.5 flex items-center gap-1.5 overflow-x-auto max-w-full [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <a href="{{ route('admin.portfolios.index') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[9999px] font-label-sm text-[10px] uppercase tracking-wider transition-colors whitespace-nowrap {{ request()->routeIs('admin.portfolios.*') ? 'bg-primary-container text-white shadow-2xs' : 'text-primary hover:bg-white/60' }}">
                    <span class="material-symbols-outlined text-[13px] leading-none">photo_library</span>
                    <span>Edit Karya</span>
                </a>

                <a href="{{ route('admin.services.index') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[9999px] font-label-sm text-[10px] uppercase tracking-wider transition-colors whitespace-nowrap {{ request()->routeIs('admin.services.*') ? 'bg-primary-container text-white shadow-2xs' : 'text-primary hover:bg-white/60' }}">
                    <span class="material-symbols-outlined text-[13px] leading-none">spa</span>
                    <span>Edit Layanan</span>
                </a>

                <a href="{{ route('admin.schedules.index') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[9999px] font-label-sm text-[10px] uppercase tracking-wider transition-colors whitespace-nowrap {{ request()->routeIs('admin.schedules.*') ? 'bg-primary-container text-white shadow-2xs' : 'text-primary hover:bg-white/60' }}">
                    <span class="material-symbols-outlined text-[13px] leading-none">event_busy</span>
                    <span>Atur Jadwal</span>
                </a>
            </div>
        @endauth

        <!-- PILL MOBILE (Sub-Navbar Khusus Mobile) -->
        <nav class="pointer-events-auto flex md:hidden items-center gap-4 px-4 py-2 rounded-2xl bg-[#FAF7F2]/40 backdrop-blur-2xl backdrop-saturate-150 border border-white/65 ring-1 ring-primary/5 shadow-[0_8px_32px_rgba(44,34,30,0.06),inset_0_1px_0_rgba(255,255,255,0.85)] overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <button type="button" data-target="portofolio-section"
                    class="nav-scroll-link shrink-0 h-7 inline-flex items-center font-label-sm uppercase tracking-[0.14em] text-[11px] text-primary font-semibold border-b-2 border-secondary transition-colors cursor-pointer">
                Portofolio
            </button>

            <button type="button" data-target="koleksi-section"
                    class="nav-scroll-link shrink-0 h-7 inline-flex items-center font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer">
                Koleksi
            </button>

            <button type="button" data-target="layanan-section"
                    class="nav-scroll-link shrink-0 h-7 inline-flex items-center font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer">
                Layanan
            </button>

            <button type="button" data-target="testimoni-section"
                    class="nav-scroll-link shrink-0 h-7 inline-flex items-center font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer">
                Ulasan
            </button>

            <button type="button" data-target="kontak-section"
                    class="nav-scroll-link shrink-0 h-7 inline-flex items-center font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-colors cursor-pointer">
                Kontak
            </button>
        </nav>

    </div>
</header>