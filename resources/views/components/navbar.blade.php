<header class="sticky top-0 z-40 w-full bg-[#FAF7F2]/95 backdrop-blur-md border-b border-outline-variant/20 transition-all">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-3.5 flex items-center justify-between gap-4">
        
        <!-- Brand / Logo -->
        <button type="button" data-target="portofolio-section" class="nav-scroll-link flex items-center gap-3 group shrink-0 text-left cursor-pointer">
            <div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary flex items-center justify-center font-headline-sm text-base tracking-wider shadow-sm group-hover:bg-secondary transition-colors shrink-0">
                RS
            </div>
            <div class="flex flex-col">
                <span class="font-headline-sm text-base tracking-[0.14em] text-primary uppercase leading-none whitespace-nowrap">
                    Aramysta Salon
                </span>
                <span class="font-label-sm text-[9px] tracking-[0.25em] text-secondary uppercase mt-1 whitespace-nowrap">
                    Haute Beauté
                </span>
            </div>
        </button>

        <!-- Menu Navigasi Desktop (Dengan Sub-Tombol Kelola di Bawah Menu Saat Mode Admin) -->
        <nav class="hidden md:flex items-start gap-7 lg:gap-9">
            
            <!-- 1. Portofolio -->
            <div class="flex flex-col items-center">
                <button type="button" data-target="portofolio-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-primary font-semibold border-b-2 border-secondary pb-1 transition-colors cursor-pointer">
                    Portofolio
                </button>
            </div>

            <!-- 2. Koleksi + Tombol Kelola Karya -->
            <div class="flex flex-col items-center gap-1.5">
                <button type="button" data-target="koleksi-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                    Koleksi
                </button>
                @auth
                    <a href="{{ route('admin.portfolios.index') }}"
                       class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md border {{ request()->routeIs('admin.portfolios.*') ? 'bg-secondary text-on-secondary border-secondary' : 'bg-surface-container-lowest text-primary border-secondary/40 hover:bg-secondary hover:text-on-secondary' }} font-label-sm text-[10px] uppercase tracking-wider transition-colors shadow-2xs whitespace-nowrap">
                        <span class="material-symbols-outlined text-[12px] leading-none">edit_square</span>
                        <span>Edit Karya</span>
                    </a>
                @endauth
            </div>

            <!-- 3. Layanan + Tombol Kelola Layanan -->
            <div class="flex flex-col items-center gap-1.5">
                <button type="button" data-target="layanan-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                    Layanan
                </button>
                @auth
                    <a href="{{ route('admin.services.index') }}"
                       class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md border {{ request()->routeIs('admin.services.*') ? 'bg-secondary text-on-secondary border-secondary' : 'bg-surface-container-lowest text-primary border-secondary/40 hover:bg-secondary hover:text-on-secondary' }} font-label-sm text-[10px] uppercase tracking-wider transition-colors shadow-2xs whitespace-nowrap">
                        <span class="material-symbols-outlined text-[12px] leading-none">edit_square</span>
                        <span>Edit Layanan</span>
                    </a>
                @endauth
            </div>

            <!-- 4. Ulasan / Jadwal + Tombol Kelola -->
            <div class="flex flex-col items-center gap-1.5">
                <button type="button" data-target="testimoni-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                    Ulasan
                </button>
                @auth
                    <a href="{{ route('admin.schedules.index') }}"
                       class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md border {{ request()->routeIs('admin.schedules.*') ? 'bg-secondary text-on-secondary border-secondary' : 'bg-surface-container-lowest text-primary border-secondary/40 hover:bg-secondary hover:text-on-secondary' }} font-label-sm text-[10px] uppercase tracking-wider transition-colors shadow-2xs whitespace-nowrap">
                        <span class="material-symbols-outlined text-[12px] leading-none">event_busy</span>
                        <span>Atur Jadwal</span>
                    </a>
                @endauth
            </div>

            <!-- 5. Kontak -->
            <div class="flex flex-col items-center">
                <button type="button" data-target="kontak-section"
                        class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                    Kontak
                </button>
            </div>
        </nav>

        <!-- Aksi Kanan (Status Admin / Tombol Reservasi & Login) -->
        <div class="flex items-center gap-1.5 sm:gap-2.5 shrink-0">
            @auth
                <span class="inline-flex items-center gap-1 sm:gap-1.5 px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-secondary-fixed/50 text-on-secondary-fixed font-label-sm text-[9px] sm:text-[10px] uppercase tracking-wider font-semibold whitespace-nowrap">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
                    <span>Mode Admin</span>
                </span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-3.5 py-1.5 sm:py-2 rounded-xl bg-surface-container-low hover:bg-error-container/60 text-primary hover:text-on-error-container font-label-sm uppercase tracking-wider text-[10px] sm:text-[11px] transition-colors cursor-pointer whitespace-nowrap">
                        <span class="material-symbols-outlined text-sm leading-none">logout</span>
                        <span>Keluar</span>
                    </button>
                </form>
            @else
                <button type="button" data-target="kontak-section"
                        class="nav-scroll-link inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 rounded-xl bg-primary-container text-on-primary hover:bg-secondary font-label-sm uppercase tracking-wider text-[10px] sm:text-[11px] transition-colors shadow-xs cursor-pointer whitespace-nowrap">
                    <span class="material-symbols-outlined text-sm leading-none">calendar_month</span>
                    <span>Reservasi</span>
                </button>

                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-1.5 px-3 sm:px-3.5 py-2 rounded-xl bg-surface-container-low hover:bg-secondary-fixed/60 text-primary border border-outline-variant/30 font-label-sm uppercase tracking-wider text-[10px] sm:text-[11px] transition-colors whitespace-nowrap">
                    <span class="material-symbols-outlined text-sm leading-none">login</span>
                    <span>Login</span>
                </a>
            @endauth
        </div>
    </div>

    <!-- Sub-Navbar Khusus Mobile (Scrollable) -->
    <nav class="flex md:hidden items-start gap-5 px-6 py-2.5 border-t border-outline-variant/15 overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
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
                   class="px-2 py-0.5 rounded bg-secondary-fixed/60 text-on-secondary-fixed text-[9px] font-label-sm uppercase tracking-wider">
                    Kelola Karya
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
                   class="px-2 py-0.5 rounded bg-secondary-fixed/60 text-on-secondary-fixed text-[9px] font-label-sm uppercase tracking-wider">
                    Kelola Layanan
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
                   class="px-2 py-0.5 rounded bg-secondary-fixed/60 text-on-secondary-fixed text-[9px] font-label-sm uppercase tracking-wider">
                    Atur Jadwal
                </a>
            @endauth
        </div>

        <button type="button" data-target="kontak-section"
                class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
            Kontak
        </button>
    </nav>
</header>