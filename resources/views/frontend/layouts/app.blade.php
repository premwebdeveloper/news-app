<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','News Blog')</title>
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
