<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Ramysta Salon - Haute Beauté & Atelier')</title>

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed": "#ffdada", "secondary-fixed-dim": "#f5b7b9", "on-tertiary-container": "#9c8c72",
                        "secondary-container": "#ffbfc1", "on-secondary-fixed": "#331013", "surface-dim": "#dcdad5",
                        "on-surface-variant": "#4e4541", "outline-variant": "#d2c4bf", "surface-variant": "#e5e2dd",
                        "surface-container-lowest": "#ffffff", "background": "#fcf9f4", "outline": "#807571",
                        "inverse-primary": "#d5c3bc", "error": "#ba1a1a", "on-secondary-fixed-variant": "#673a3c",
                        "on-secondary-container": "#7b4b4d", "surface-container-highest": "#e5e2dd", "primary": "#1a110d",
                        "error-container": "#ffdad6", "primary-fixed": "#f2ded8", "tertiary-fixed-dim": "#d6c4a7",
                        "tertiary-container": "#302612", "on-primary-container": "#9c8b85", "surface": "#fcf9f4",
                        "on-tertiary-fixed": "#241a07", "on-primary-fixed": "#231916", "secondary": "#825153",
                        "on-surface": "#1c1c19", "surface-container-high": "#ebe8e3", "on-primary": "#ffffff",
                        "on-error": "#ffffff", "tertiary-fixed": "#f3e0c2", "tertiary": "#1a1102",
                        "on-tertiary-fixed-variant": "#51452f", "surface-tint": "#6a5b56", "on-background": "#1c1c19",
                        "primary-container": "#302521", "on-tertiary": "#ffffff", "surface-container": "#f0ede9",
                        "on-secondary": "#ffffff", "inverse-surface": "#31302d", "surface-container-low": "#f6f3ee",
                        "inverse-on-surface": "#f3f0eb", "surface-bright": "#fcf9f4", "on-error-container": "#93000a",
                        "on-primary-fixed-variant": "#51443f", "primary-fixed-dim": "#d5c3bc"
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                    fontFamily: {
                        "body-md": ["DM Sans"], "headline-sm": ["Playfair Display"],
                        "headline-md": ["Playfair Display"], "body-sm": ["DM Sans"],
                        "label-sm": ["DM Sans"], "label-md": ["DM Sans"], "display-lg": ["Playfair Display"],
                        "body-lg": ["DM Sans"], "subhead-uppercase": ["DM Sans"], "headline-lg": ["Playfair Display"]
                    },
                    fontSize: {
                        "body-md": ["0.9375rem", { "lineHeight": "1.6rem", "letterSpacing": "0.01em", "fontWeight": "400" }],
                        "headline-sm": ["1.25rem", { "lineHeight": "1.75rem", "letterSpacing": "0em", "fontWeight": "500" }],
                        "headline-md": ["1.75rem", { "lineHeight": "2.25rem", "letterSpacing": "-0.01em", "fontWeight": "500" }],
                        "body-sm": ["0.8125rem", { "lineHeight": "1.35rem", "letterSpacing": "0.01em", "fontWeight": "400" }],
                        "label-sm": ["0.6875rem", { "lineHeight": "0.875rem", "letterSpacing": "0.12em", "fontWeight": "600" }],
                        "label-md": ["0.875rem", { "lineHeight": "1.25rem", "letterSpacing": "0.04em", "fontWeight": "500" }],
                        "display-lg": ["3.5rem", { "lineHeight": "4rem", "letterSpacing": "-0.02em", "fontWeight": "400" }],
                        "body-lg": ["1.125rem", { "lineHeight": "1.875rem", "letterSpacing": "0em", "fontWeight": "400" }],
                        "subhead-uppercase": ["0.75rem", { "lineHeight": "1rem", "letterSpacing": "0.18em", "fontWeight": "600" }],
                        "headline-lg": ["2.5rem", { "lineHeight": "3rem", "letterSpacing": "-0.015em", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS Ramysta Salon -->
    <link rel="stylesheet" href="{{ asset('css/ramysta.css') }}">
    @stack('styles')
</head>
<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed">

    @include('components.navbar')

    <main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
        @yield('content')
    </main>

    <!-- Custom JS Ramysta Salon -->
    <script src="{{ asset('js/ramysta.js') }}"></script>
    @stack('scripts')


</body>
</html>