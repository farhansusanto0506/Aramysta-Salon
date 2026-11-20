<header class="sticky top-0 z-40 w-full bg-[#FAF7F2]/90 backdrop-blur-md border-b border-outline-variant/20 transition-all">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between gap-4">
        
        <!-- Brand / Logo -->
        <a href="{{ url('/') }}" data-target="portofolio-section" class="nav-scroll-link flex items-center gap-3 group shrink-0">
            <div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary flex items-center justify-center font-headline-sm text-base tracking-wider shadow-sm group-hover:bg-secondary transition-colors">
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
        </a>

        <!-- Menu Navigasi Desktop -->
        <nav class="hidden md:flex items-center gap-8">
            <button type="button" data-target="portofolio-section"
                    class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-primary font-semibold border-b-2 border-secondary pb-1 transition-colors cursor-pointer">
                Portofolio
            </button>
            <button type="button" data-target="koleksi-section"
                    class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                Koleksi
            </button>
            <button type="button" data-target="layanan-section"
                    class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                Layanan
            </button>
            <button type="button" data-target="testimoni-section"
                    class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                Testimoni
            </button>
            <button type="button" data-target="kontak-section"
                    class="nav-scroll-link font-label-sm uppercase tracking-[0.16em] text-xs text-on-surface-variant hover:text-primary pb-1 border-b-2 border-transparent transition-colors cursor-pointer">
                Kontak
            </button>
        </nav>

        <!-- Aksi Kanan (Status Admin / Tombol Reservasi) -->
        <div class="flex items-center gap-2.5 shrink-0">
            @auth
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-secondary-fixed/50 text-on-secondary-fixed font-label-sm text-[10px] uppercase tracking-wider font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
                    Mode Admin
                </span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-surface-container-low hover:bg-error-container/60 text-primary hover:text-on-error-container font-label-sm uppercase tracking-wider text-[11px] transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-sm leading-none">logout</span>
                        <span>Keluar</span>
                    </button>
                </form>
            @else
                <button type="button" data-target="kontak-section"
                        class="nav-scroll-link inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary-container text-on-primary hover:bg-secondary font-label-sm uppercase tracking-wider text-[11px] transition-colors shadow-xs cursor-pointer">
                    <span class="material-symbols-outlined text-sm leading-none">calendar_month</span>
                    <span>Reservasi</span>
                </button>
            @endauth
        </div>
    </div>

    <!-- Sub-Navbar Khusus Mobile (Scrollable) -->
    <nav class="flex md:hidden items-center gap-5 px-6 py-2.5 border-t border-outline-variant/15 overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
        <button type="button" data-target="portofolio-section"
                class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-primary font-semibold border-b-2 border-secondary pb-0.5 transition-colors cursor-pointer">
            Portofolio
        </button>
        <button type="button" data-target="koleksi-section"
                class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
            Koleksi
        </button>
        <button type="button" data-target="layanan-section"
                class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
            Layanan
        </button>
        <button type="button" data-target="testimoni-section"
                class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
            Testimoni
        </button>
        <button type="button" data-target="kontak-section"
                class="nav-scroll-link shrink-0 font-label-sm uppercase tracking-[0.14em] text-[11px] text-on-surface-variant hover:text-primary pb-0.5 border-b-2 border-transparent transition-colors cursor-pointer">
            Kontak
        </button>
    </nav>
</header>