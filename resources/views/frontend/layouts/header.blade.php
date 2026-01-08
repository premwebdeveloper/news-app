<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        <a href="/" class="flex items-center gap-2">
            <span class="bg-red-600 text-white px-2 py-1 font-bold">NEWS</span>
            <span class="font-bold text-xl">BLOG</span>
        </a>

        <nav class="hidden md:flex gap-6 font-semibold">
            <a href="/" class="hover:text-red-600">Home</a>
            <a href="/category/politics" class="hover:text-red-600">Politics</a>
            <a href="/category/sports" class="hover:text-red-600">Sports</a>
            <a href="/category/technology" class="hover:text-red-600">Technology</a>
        </nav>

        <div class="flex gap-4 items-center">
            @auth
                <a href="/dashboard" class="text-sm font-semibold">Dashboard</a>
            @else
                <a href="/login" class="text-sm font-semibold">Login</a>
                <a href="/register" class="bg-red-600 text-white px-4 py-2 rounded text-sm">
                    Register
                </a>
            @endauth
        </div>
    </div>
</header>
