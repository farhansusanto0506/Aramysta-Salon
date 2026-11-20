<header class="sticky top-0 z-40 w-full px-3 sm:px-6 lg:px-10 pt-3 sm:pt-4 pointer-events-none">
    <div class="max-w-7xl mx-auto flex flex-col gap-2">

        <!-- Baris Utama: Pill Kiri (Brand + Navigasi Desktop) & Pill Kanan (Aksi / Admin) -->
        <div class="flex flex-wrap md:flex-nowrap items-stretch md:items-center justify-between gap-2.5 sm:gap-3">

            <!-- PILL 1 (KIRI / TENGAH): Logo + Menu Navigasi Desktop -->
            <div class="pointer-events-auto flex-1 min-w-0 rounded-2xl md:rounded-[9999px] bg-[#FAF7F2]/40 backdrop-blur-2xl backdrop-saturate-150 border border-white/65 ring-1 ring-primary/5 shadow-[0_8px_32px_rgba(44,34,30,0.07),inset_0_1px_0_rgba(255,255,255,0.88)] px-4 sm:px-6 py-2.5 flex items-center justify-between gap-4 lg:gap-8 transition-all duration-300">

                <!-- Brand / Logo -->
                <button type="button" data-target="portofolio-section" class="nav-scroll-link flex items-center gap-2.5 sm:gap-3 group shrink-0 text-left cursor-pointer">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-[9999px] bg-primary-container/95 text-on-primary flex items-center justify-center font-headline-sm text-sm tracking-wider shadow-sm group-hover:bg-secondary transition-colors shrink-0">
                        RS
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

                <!-- Menu Navigasi Desktop -->
                <nav class="hidden md:flex items-center gap-5 lg:gap-7">
                    <!-- 1. Portofolio -->
                    <div class="flex flex-col items-center">
                        <button type="button" data-target="portofolio-section"
                                class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-primary font-semibold border-b-2 border-secondary pb-0.5 transition-colors cursor-pointer">
                            Portofolio
                        </button>
                    </div>

                    <!-- 2. Koleksi + Tombol Kelola Karya -->
                    <div class="flex flex-col items-center gap-1">
                        <button type="button" data-target="koleksi-section"
                                class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                            Koleksi
                        </button>
                        @auth
                            <a href="{{ route('admin.portfolios.index') }}"
                               class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-[9999px] border {{ request()->routeIs('admin.portfolios.*') ? 'bg-secondary text-on-secondary border-secondary' : 'bg-white/45 text-primary border-secondary/30 hover:bg-secondary hover:text-on-secondary' }} font-label-sm text-[9px] uppercase tracking-wider transition-colors backdrop-blur-md whitespace-nowrap">
                                <span class="material-symbols-outlined text-[11px] leading-none">edit_square</span>
                                <span>Edit Karya</span>
                            </a>
                        @endauth
                    </div>

                    <!-- 3. Layanan + Tombol Kelola Layanan -->
                    <div class="flex flex-col items-center gap-1">
                        <button type="button" data-target="layanan-section"
                                class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                            Layanan
                        </button>
                        @auth
                            <a href="{{ route('admin.services.index') }}"
                               class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-[9999px] border {{ request()->routeIs('admin.services.*') ? 'bg-secondary text-on-secondary border-secondary' : 'bg-white/45 text-primary border-secondary/30 hover:bg-secondary hover:text-on-secondary' }} font-label-sm text-[9px] uppercase tracking-wider transition-colors backdrop-blur-md whitespace-nowrap">
                                <span class="material-symbols-outlined text-[11px] leading-none">edit_square</span>
                                <span>Edit Layanan</span>
                            </a>
                        @endauth
                    </div>

                    <!-- 4. Ulasan + Tombol Jadwal -->
                    <div class="flex flex-col items-center gap-1">
                        <button type="button" data-target="testimoni-section"
                                class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                            Ulasan
                        </button>
                        @auth
                            <a href="{{ route('admin.schedules.index') }}"
                               class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-[9999px] border {{ request()->routeIs('admin.schedules.*') ? 'bg-secondary text-on-secondary border-secondary' : 'bg-white/45 text-primary border-secondary/30 hover:bg-secondary hover:text-on-secondary' }} font-label-sm text-[9px] uppercase tracking-wider transition-colors backdrop-blur-md whitespace-nowrap">
                                <span class="material-symbols-outlined text-[11px] leading-none">event_busy</span>
                                <span>Jadwal</span>
                            </a>
                        @endauth
                    </div>

                    <!-- 5. Kontak -->
                    <div class="flex flex-col items-center">
                        <button type="button" data-target="kontak-section"
                                class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                            Kontak
                        </button>
                    </div>
                </nav>
            </div>

            <!-- PILL 2 (KANAN): Status Admin / Tombol Reservasi & Login -->
            <div class="pointer-events-auto rounded-2xl md:rounded-[9999px] bg-[#FAF7F2]/40 backdrop-blur-2xl backdrop-saturate-150 border border-white/65 ring-1 ring-primary/5 shadow-[0_8px_32px_rgba(44,34,30,0.07),inset_0_1px_0_rgba(255,255,255,0.88)] px-3 sm:px-4 py-2 flex items-center justify-end gap-1.5 sm:gap-2 shrink-0 transition-all duration-300">
                @auth
                    <span class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-3 py-1.5 rounded-[9999px] bg-secondary-fixed/55 border border-white/60 text-on-secondary-fixed font-label-sm text-[9px] sm:text-[10px] uppercase tracking-wider font-semibold whitespace-nowrap backdrop-blur-md">
                        <span class="w-1.5 h-1.5 rounded-[9999px] bg-secondary animate-pulse"></span>
                        <span>Mode Admin</span>
                    </span>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-1 sm:gap-1.5 px-3 sm:px-3.5 py-2 rounded-[9999px] bg-white/45 hover:bg-error-container/70 border border-white/65 text-primary hover:text-on-error-container font-label-sm uppercase tracking-wider text-[10px] sm:text-[11px] transition-all cursor-pointer whitespace-nowrap shadow-2xs">
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

        <!-- PILL MOBILE (Sub-Navbar Khusus Mobile) -->
        <nav class="pointer-events-auto flex md:hidden items-start gap-4 px-4 py-2 rounded-2xl bg-[#FAF7F2]/40 backdrop-blur-2xl backdrop-saturate-150 border border-white/65 ring-1 ring-primary/5 shadow-[0_8px_32px_rgba(44,34,30,0.06),inset_0_1px_0_rgba(255,255,255,0.85)] overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <button type="button" data-target="portofolio-section"
                    class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-primary font-semibold border-b-2 border-secondary pb-0.5 transition-colors cursor-pointer">
                Portofolio
            </button>

            <div class="flex flex-col items-center gap-1 shrink-0">
                <button type="button" data-target="koleksi-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                    Koleksi
                </button>
                @auth
                    <a href="{{ route('admin.portfolios.index') }}"
                       class="px-2 py-0.5 rounded-[9999px] bg-white/50 border border-secondary/30 text-primary text-[9px] font-label-sm uppercase tracking-wider">
                        Kelola
                    </a>
                @endauth
            </div>

            <div class="flex flex-col items-center gap-1 shrink-0">
                <button type="button" data-target="layanan-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                    Layanan
                </button>
                @auth
                    <a href="{{ route('admin.services.index') }}"
                       class="px-2 py-0.5 rounded-[9999px] bg-white/50 border border-secondary/30 text-primary text-[9px] font-label-sm uppercase tracking-wider">
                        Kelola
                    </a>
                @endauth
            </div>

            <div class="flex flex-col items-center gap-1 shrink-0">
                <button type="button" data-target="testimoni-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                    Ulasan
                </button>
                @auth
                    <a href="{{ route('admin.schedules.index') }}"
                       class="px-2 py-0.5 rounded-[9999px] bg-white/50 border border-secondary/30 text-primary text-[9px] font-label-sm uppercase tracking-wider">
                        Jadwal
                    </a>
                @endauth
            </div>

            <button type="button" data-target="kontak-section"
                    class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
                Kontak
            </button>
        </nav>

    </div>
</header>