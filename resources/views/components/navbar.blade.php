<header
    class="fixed top-0 left-0 right-0 z-50 bg-[#FAF7F2]/95 backdrop-blur-md border-b border-primary-container/10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between gap-4">

        <!-- 1. Brand Logo & Name (Kiri) -->
        <div class="flex items-center shrink-0">
            <a class="flex items-center gap-3 group" href="{{ route('portfolio.index') }}">
                <div
                    class="w-9 h-9 rounded-full bg-primary-container text-tertiary-fixed flex items-center justify-center font-headline-sm text-base tracking-wider shadow-sm group-hover:bg-secondary transition-colors">
                    RS
                </div>
                <div class="flex flex-col leading-none border-l border-primary-container/15 pl-3">
                    <span class="font-headline-sm text-primary tracking-wide uppercase text-base">RAMYSTA SALON</span>
                    <span
                        class="font-label-sm text-on-surface-variant text-[0.62rem] tracking-[0.22em] uppercase mt-1">Haute
                        Beauté</span>
                </div>
            </a>
        </div>

        <!-- 2. Navigation Links (Tengah) -->
        <nav class="hidden xl:flex items-center space-x-6" id="mainNav">
            @php $isHome = request()->routeIs('portfolio.index'); @endphp

            <a href="{{ $isHome ? '#portofolio-section' : route('portfolio.index') }}" data-target="portofolio-section"
                class="nav-scroll-link font-label-md uppercase tracking-wider text-xs py-1 transition-colors {{ $isHome ? 'text-primary font-semibold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-primary' }}">
                Portofolio
            </a>
            <a href="{{ $isHome ? '#koleksi-section' : route('portfolio.index') }}" data-target="koleksi-section"
                class="nav-scroll-link font-label-md uppercase tracking-wider text-xs py-1 transition-colors text-on-surface-variant hover:text-primary">
                Koleksi
            </a>
            <a href="{{ $isHome ? '#client-love' : route('portfolio.index') }}"
                class="font-label-md uppercase tracking-wider text-xs py-1 text-on-surface-variant hover:text-primary transition-colors">
                Testimoni
            </a>
            <a href="#"
                class="font-label-md uppercase tracking-wider text-xs py-1 text-on-surface-variant hover:text-primary transition-colors">
                Layanan
            </a>
            <a href="#"
                class="font-label-md uppercase tracking-wider text-xs py-1 text-on-surface-variant hover:text-primary transition-colors">
                Kontak
            </a>
        </nav>

        <!-- 3. Action Buttons (Kanan) -->
        <div class="flex items-center gap-2.5 shrink-0">
            @auth
                <!-- Badge Status Admin -->
                <span
                    class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-tertiary-fixed/60 text-primary font-label-sm text-[10px] uppercase tracking-widest mr-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    Mode Admin
                </span>

                <!-- Tombol Kelola Karya -->
                <a href="{{ route('admin.portfolios.index') }}"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg font-label-sm uppercase tracking-wider text-[11px] transition-all {{ request()->routeIs('admin.portfolios.*') ? 'bg-primary-container text-on-primary shadow-sm' : 'bg-surface-container text-primary hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-sm leading-none">photo_library</span>
                    <span>Kelola Karya</span>
                </a>

                <!-- Pembatas Vertikal -->
                <div class="h-5 w-px bg-outline-variant/50 mx-1"></div>

                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1 px-3 py-2 rounded-lg font-label-sm uppercase tracking-wider text-[11px] text-error hover:bg-error-container/40 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-sm leading-none">logout</span>
                        <span>Keluar</span>
                    </button>
                </form>
            @else
                <!-- Mode Pengunjung -->
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg font-label-md uppercase tracking-wider text-xs text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined text-base leading-none">lock</span>
                    <span>Admin</span>
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center font-label-md uppercase tracking-[0.12em] bg-primary-container text-on-primary px-5 py-2.5 rounded-lg text-xs hover:bg-secondary transition-colors shadow-sm">
                    Reservasi
                </a>
            @endauth
        </div>

    </div>
</header>
