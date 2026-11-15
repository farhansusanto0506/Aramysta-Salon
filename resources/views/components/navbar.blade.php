<header class="fixed top-0 left-0 right-0 z-50 bg-[#FAF7F2]/90 backdrop-blur-md border-b border-primary-container/10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between gap-4">
        <!-- Brand Logo & Name -->
        <div class="flex items-center gap-3 shrink-0">
            <a class="flex items-center gap-3 group" href="{{ url('/') }}">
                <div class="w-9 h-9 rounded-full bg-primary-container text-tertiary-fixed flex items-center justify-center font-headline-sm text-lg tracking-wider shadow-sm">
                    RS
                </div>
                <div class="flex flex-col leading-none border-l border-primary-container/15 pl-3">
                    <span class="font-headline-sm text-primary tracking-wide uppercase">RAMYSTA SALON</span>
                </div>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden xl:flex items-center space-x-6">
            <a class="font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors py-1" href="#">Beranda</a>
            <a class="font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors py-1" href="#">Tentang</a>
            <a class="font-label-md uppercase tracking-wider text-primary font-semibold border-b border-secondary transition-colors py-1" href="#">Portofolio</a>
            <a class="font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors py-1" href="#">Layanan</a>
            <a class="font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors py-1" href="#">Reservasi</a>
            <a class="font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors py-1" href="#">Testimoni</a>
            <a class="font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors py-1 whitespace-nowrap" href="#">Tanya Jawab</a>
            <a class="font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors py-1" href="#">Kontak</a>
        </nav>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3 shrink-0">
            <a class="hidden md:inline-flex items-center gap-1.5 font-label-md uppercase tracking-wider text-on-surface-variant hover:text-primary transition-colors text-xs" href="#">
                <span class="material-symbols-outlined text-base leading-none">lock</span>
                <span>Portal Klien</span>
            </a>
            <a class="inline-flex items-center justify-center font-label-md uppercase tracking-[0.12em] bg-primary-container text-on-primary px-4 py-2 rounded-lg border border-primary-container transition-all duration-300 hover:bg-tertiary-fixed hover:text-primary hover:border-tertiary-fixed-dim shadow-[0_2px_10px_rgba(48,37,33,0.08)] text-xs" href="#">
                Reservasi
            </a>
        </div>
    </div>
</header>