<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @yield('seo_title', 'News Blog')
        </title>
        
        <meta name="description" content="@yield('meta_description', 'Latest news and updates')">

        <meta name="google-site-verification" content="merILrsnwhE7rICFXgH_zI0uRAmHJVVBpSC5niEG_q0" />

        <meta name="keywords" content="@yield('meta_keywords', 'news, jobs, updates')">

        {{-- Bootstrap CSS --}}
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        >

        @vite(['resources/css/app.css','resources/js/app.js'])
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

    </body>
</html>
