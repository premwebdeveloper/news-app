<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @yield('seo_title', 'Panchayat 365 – Latest Indian News, Jobs & Updates')
        </title>
        
        <meta name="description" content="@yield('meta_description', 'Panchayat 365 is a dynamic news blog covering politics, jobs, entertainment, technology, sports and local updates with fresh stories from every category every day.')">

        <meta name="google-site-verification" content="merILrsnwhE7rICFXgH_zI0uRAmHJVVBpSC5niEG_q0" />

        <meta name="keywords" content="@yield('meta_keywords', 'news, jobs, updates')">

        {{-- Canonical URL for SEO (defaults to current URL) --}}
        <link rel="canonical" href="@yield('canonical', url()->current())">

        {{-- Bootstrap CSS --}}
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        >

        {{-- Livewire Styles --}}
        @livewireStyles

        @vite(['resources/css/app.css','resources/js/app.js'])

        <style>
            .collapse {
                visibility: visible !important;
            }
        </style>
    </head>
    <body class="bg-light">

        @include('frontend.layouts.header')

        <main class="min-vh-100">
            @yield('content')
        </main>

        @include('frontend.layouts.footer')

        {{-- Bootstrap JS (optional, for navbar toggler and components) --}}
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>

        {{-- Livewire Scripts --}}
        @livewireScripts

    </body>
</html>
