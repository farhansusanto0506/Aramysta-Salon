<!DOCTYPE html>
<html class="scroll-smooth" lang="id">

<head>
    @include('layouts.partials.head')
</head>

<body
    class="bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">

    @include('components.navbar')

    <main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')

</body>

</html>
