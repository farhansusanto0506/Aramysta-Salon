@php
    $adminNav = [
        ['route' => 'admin.portfolios.index', 'match' => 'admin.portfolios.*', 'icon' => 'photo_library', 'label' => 'Portofolio'],
        ['route' => 'admin.services.index', 'match' => 'admin.services.*', 'icon' => 'spa', 'label' => 'Layanan'],
        ['route' => 'admin.schedules.index', 'match' => 'admin.schedules.*', 'icon' => 'event_available', 'label' => 'Jadwal'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.partials.head')
</head>

<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">

    <!-- Sidebar -->
    <aside id="adminSidebar"
        class="admin-sidebar fixed inset-y-0 left-0 z-50 w-64 bg-primary-container text-white flex flex-col">
        <div class="h-20 px-6 flex items-center gap-3 border-b border-white/10">
            <span
                class="w-10 h-10 rounded-full bg-white/10 text-white flex items-center justify-center font-headline-sm text-sm tracking-wider ring-1 ring-white/20 shrink-0">
                AS
            </span>
            <span class="flex flex-col">
                <span class="font-headline-sm text-sm tracking-[0.16em] uppercase leading-none">Aramysta Salon</span>
                <span class="font-label-sm text-[9px] tracking-[0.28em] text-secondary-fixed-dim uppercase mt-1.5">Panel Admin</span>
            </span>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-6 flex flex-col gap-1" aria-label="Menu admin">
            <span class="px-3 mb-2 font-label-sm text-[10px] uppercase tracking-[0.2em] text-white/40">Kelola</span>

            @foreach ($adminNav as $item)
                <a href="{{ route($item['route']) }}"
                    class="admin-link {{ request()->routeIs($item['match']) ? 'is-active' : '' }}"
                    @if (request()->routeIs($item['match'])) aria-current="page" @endif>
                    <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach

            <a href="{{ route('portfolio.index') }}" class="admin-link"
                title="Foto hero diedit langsung di halaman utama">
                <span class="material-symbols-outlined">edit_document</span>
                <span>Konten</span>
            </a>

            <span class="px-3 mt-6 mb-2 font-label-sm text-[10px] uppercase tracking-[0.2em] text-white/40">Website</span>

            <a href="{{ route('portfolio.index') }}" target="_blank" rel="noopener" class="admin-link">
                <span class="material-symbols-outlined">open_in_new</span>
                <span>Lihat Website</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            @auth
                <div class="px-3 mb-3 min-w-0">
                    <span class="block text-[10px] uppercase tracking-[0.18em] text-white/40">Masuk sebagai</span>
                    <span class="block text-xs text-white/80 truncate mt-0.5">{{ auth()->user()->email }}</span>
                </div>
            @endauth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="admin-link w-full">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Scrim Mobile -->
    <div class="admin-scrim fixed inset-0 z-40 bg-primary/40 backdrop-blur-xs lg:hidden" data-sidebar-close
        aria-hidden="true"></div>

    <div class="lg:pl-64 min-h-screen flex flex-col">
        <!-- Topbar -->
        <header
            class="sticky top-0 z-30 h-16 lg:h-20 bg-surface/85 backdrop-blur-xl border-b border-outline-variant/40">
            <div class="h-full px-5 sm:px-8 lg:px-10 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <button type="button" id="adminSidebarToggle" aria-controls="adminSidebar" aria-expanded="false"
                        aria-label="Buka menu admin"
                        class="lg:hidden w-10 h-10 rounded-full bg-white border border-outline-variant/60 text-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl">menu</span>
                    </button>
                    <span class="font-headline-sm text-base sm:text-lg text-primary truncate">
                        @yield('page_title', 'Panel Admin')
                    </span>
                </div>

                <a href="{{ route('portfolio.index') }}" target="_blank" rel="noopener"
                    class="btn btn-ghost btn-sm shrink-0">
                    <span class="material-symbols-outlined text-sm leading-none">visibility</span>
                    <span class="hidden sm:inline">Lihat Website</span>
                </a>
            </div>
        </header>

        <main class="flex-1 px-5 sm:px-8 lg:px-10 py-8 lg:py-10">
            <div class="max-w-6xl mx-auto">
                <!-- Flash Message -->
                @if (session('success'))
                    <div class="alert alert-success mb-6" role="status" data-alert data-alert-autodismiss="5000">
                        <span class="material-symbols-outlined text-lg leading-none text-secondary">check_circle</span>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                            <span class="material-symbols-outlined text-base leading-none">close</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error mb-6" role="alert" data-alert>
                        <span class="material-symbols-outlined text-lg leading-none">error</span>
                        <div class="space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                            <span class="material-symbols-outlined text-base leading-none">close</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="px-5 sm:px-8 lg:px-10 py-6 text-[11px] text-on-surface-variant/70 border-t border-outline-variant/30">
            &copy; {{ date('Y') }} Aramysta Salon · Panel Admin
        </footer>
    </div>

    @stack('scripts')
</body>

</html>
