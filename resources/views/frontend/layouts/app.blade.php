<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>
            @yield('seo_title', 'News Blog')
        </title>
        
        <meta name="description" content="@yield('meta_description', 'Latest news and updates')">

        <meta name="keywords" content="@yield('meta_keywords', 'news, jobs, updates')">
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="bg-gray-100">

        @include('frontend.layouts.header')

        <main class="min-h-screen">
            @yield('content')
        </main>

        @include('frontend.layouts.footer')

    </body>
</html>
