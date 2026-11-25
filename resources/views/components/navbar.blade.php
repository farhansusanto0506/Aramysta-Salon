@php
    $navItems = [
        'portofolio-section' => 'Beranda',
        'tentang-section' => 'Tentang',
        'koleksi-section' => 'Portofolio',
        'layanan-section' => 'Layanan',
        'testimoni-section' => 'Ulasan',
        'kontak-section' => 'Kontak',
    ];
@endphp

<header id="siteHeader" class="site-header fixed inset-x-0 top-0 z-40">
    <div class="site-header__bar">
        <div class="container-luxe site-header__inner flex items-center justify-between gap-4">

            <!-- Brand -->
            <button type="button" data-target="portofolio-section"
                class="nav-scroll-link flex items-center gap-3 group shrink-0 text-left">
                <img src="{{ asset('images/logo-mark.png') }}" alt="Logo Aramysta" width="40" height="40"
                    class="brand-mark w-10 h-10 rounded-full object-cover ring-1 ring-gold/50 ring-offset-2 ring-offset-surface shrink-0">
                <span class="flex flex-col">
                    <span
                        class="font-headline-sm text-sm sm:text-base tracking-[0.16em] text-primary uppercase leading-none whitespace-nowrap">
                        Aramysta Salon
                    </span>
                    <span
                        class="font-label-sm text-[9px] tracking-[0.28em] text-gold uppercase mt-1.5 whitespace-nowrap">
                        Haute Beauté
                    </span>
                </span>
            </button>

            <!-- Navigasi Desktop -->
            <nav class="hidden lg:flex items-center gap-8" aria-label="Navigasi utama">
                @foreach ($navItems as $target => $label)
                    <button type="button" data-target="{{ $target }}"
                        class="nav-scroll-link nav-link {{ $loop->first ? 'is-active' : '' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </nav>

            <!-- Aksi -->
            <div class="flex items-center gap-2 shrink-0">
                @auth
                    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-ghost btn-sm hidden sm:inline-flex">
                        <span class="material-symbols-outlined text-sm leading-none">dashboard</span>
                        <span>Panel Admin</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="material-symbols-outlined text-sm leading-none">logout</span>
                            <span>Keluar</span>
                        </button>
                    </form>
                @else
                    <button type="button" data-target="kontak-section"
                        class="nav-scroll-link cta-reservasi-btn btn btn-primary btn-sm hidden sm:inline-flex">
                        <span class="material-symbols-outlined text-sm leading-none">calendar_month</span>
                        <span>Reservasi</span>
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm hidden sm:inline-flex">
                        <span class="material-symbols-outlined text-sm leading-none">login</span>
                        <span>Login</span>
                    </a>
                @endauth

                <!-- Tombol Menu Mobile -->
                <button type="button" id="mobileMenuToggle" aria-controls="mobileMenu" aria-expanded="false"
                    aria-label="Buka menu"
                    class="lg:hidden w-11 h-11 rounded-full bg-white/70 border border-outline-variant/60 text-primary flex flex-col items-center justify-center gap-1 transition-colors hover:border-secondary">
                    <span class="menu-toggle__line"></span>
                    <span class="menu-toggle__line"></span>
                    <span class="menu-toggle__line"></span>
                </button>
            </div>
        </div>
        <span class="scroll-progress" aria-hidden="true"></span>
    </div>

    <!-- Menu Mobile -->
    <div id="mobileMenu" class="mobile-menu lg:hidden absolute inset-x-0 top-full px-4 pt-2">
        <div class="panel mx-auto max-w-md p-5 shadow-[var(--shadow-lift)]">
            <nav class="flex flex-col" aria-label="Navigasi mobile">
                @foreach ($navItems as $target => $label)
                    <button type="button" data-target="{{ $target }}"
                        class="nav-scroll-link nav-link {{ $loop->first ? 'is-active' : '' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </nav>

            <div class="grid grid-cols-2 gap-2 mt-5">
                @auth
                    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-ghost btn-sm">
                        <span class="material-symbols-outlined text-sm leading-none">dashboard</span>
                        <span>Panel Admin</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm w-full">
                            <span class="material-symbols-outlined text-sm leading-none">logout</span>
                            <span>Keluar</span>
                        </button>
                    </form>
                @else
                    <button type="button" data-target="kontak-section"
                        class="nav-scroll-link cta-reservasi-btn btn btn-primary btn-sm">
                        <span class="material-symbols-outlined text-sm leading-none">calendar_month</span>
                        <span>Reservasi</span>
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">
                        <span class="material-symbols-outlined text-sm leading-none">login</span>
                        <span>Login</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
