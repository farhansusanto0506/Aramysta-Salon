@extends('layouts.app')

@section('title', 'Login Admin - Ramysta Salon')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md bg-surface-container-lowest rounded-2xl shadow-xl p-8 border border-outline-variant/30">
        <div class="text-center mb-6">
            <h1 class="font-headline-lg text-headline-lg text-primary">Login Admin</h1>
            <p class="font-body-sm text-on-surface-variant mt-1">Masuk untuk mengelola portofolio Ramysta Salon.</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-error-container text-on-error-container text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div class="flex flex-col gap-1">
                <label class="font-label-sm uppercase text-on-surface-variant">Email</label>
                <input type="email" name="email" value="{{ old('email', 'admin@ramysta.com') }}" required class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-label-sm uppercase text-on-surface-variant">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="rounded-lg bg-surface-container-low border-transparent focus:border-secondary focus:ring-secondary text-primary">
            </div>

            <button type="submit" class="mt-2 w-full py-3 rounded-lg bg-primary-container text-on-primary font-label-md uppercase tracking-widest text-xs hover:bg-secondary transition-colors">
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection