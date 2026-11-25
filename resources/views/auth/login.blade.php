<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @include('layouts.partials.head')
</head>

<body
    class="min-h-screen bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">

    <div class="relative min-h-screen flex items-center justify-center px-5 py-12 overflow-hidden">
        <!-- Ambient Glow -->
        <div class="absolute -top-40 -right-20 w-[28rem] h-[28rem] bg-tertiary-fixed/50 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute -bottom-40 -left-20 w-[26rem] h-[26rem] bg-secondary-fixed/50 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="w-full max-w-md">
            <!-- Brand -->
            <a href="{{ route('portfolio.index') }}" class="hero-enter flex flex-col items-center gap-3 mb-8 group" style="--d: 0">
                <img src="{{ asset('images/logo-full.png') }}" alt="Logo Aramysta" width="112" height="112"
                    class="w-28 h-28 rounded-2xl object-cover shadow-md ring-1 ring-secondary-fixed-dim/50">
                <span class="flex flex-col items-center">
                    <span class="font-headline-sm text-lg tracking-[0.18em] text-primary uppercase leading-none">Aramysta Salon</span>
                    <span class="font-label-sm text-[9px] tracking-[0.3em] text-secondary uppercase mt-2">Haute Beauté</span>
                </span>
            </a>

            <div class="hero-enter panel p-7 sm:p-9 shadow-[var(--shadow-lift)]" style="--d: 1">
                <div class="text-center mb-7">
                    <h1 class="font-headline-lg text-3xl text-primary">Login <span class="italic text-secondary">Admin</span></h1>
                    <p class="font-body-sm text-sm text-on-surface-variant mt-2">Masuk untuk mengelola portofolio Aramysta Salon.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-error mb-5" role="alert" data-alert>
                        <span class="material-symbols-outlined text-lg leading-none">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" autocomplete="off" class="flex flex-col gap-5">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="loginEmail" class="field-label">Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-lg text-on-surface-variant/60 pointer-events-none">mail</span>
                            <input type="email" id="loginEmail" name="email" value="{{ old('email') }}" required
                                autocomplete="off" placeholder="Masukkan email admin" class="field pl-11">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="loginPassword" class="field-label">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-lg text-on-surface-variant/60 pointer-events-none">lock</span>
                            <input type="password" id="loginPassword" name="password" required autocomplete="new-password"
                                placeholder="••••••••" class="field pl-11">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-full mt-1 py-4">
                        <span>Masuk</span>
                        <span class="material-symbols-outlined text-base leading-none">arrow_forward</span>
                    </button>
                </form>
            </div>

            <a href="{{ route('portfolio.index') }}"
                class="hero-enter mt-6 flex items-center justify-center gap-1.5 text-xs text-on-surface-variant hover:text-secondary transition-colors"
                style="--d: 2">
                <span class="material-symbols-outlined text-sm leading-none">arrow_back</span>
                <span>Kembali ke website</span>
            </a>
        </div>
    </div>

</body>

</html>
