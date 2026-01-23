<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="bg-red-600 text-white px-2 py-1 font-bold">Panchayat</span>
            <span class="font-bold text-xl">365</span>
        </a>

        {{-- Dynamic Menu --}}
        <nav class="hidden md:flex gap-6 font-semibold">
            <a href="{{ route('home') }}"
               class="hover:text-red-600 {{ request()->routeIs('home') ? 'text-red-600' : '' }}">
                Home
            </a>

            @foreach($menuCategories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="hover:text-red-600
                   {{ request()->is('category/'.$cat->slug) ? 'text-red-600' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </nav>

        {{-- Auth Links --}}
        <div class="flex gap-4 items-center">
            @auth
                <a href="/dashboard" class="text-sm font-semibold">
                    Dashboard
                </a>
            @else
                <a href="/login" class="text-sm font-semibold">
                    Login
                </a>
                <a href="/register"
                   class="bg-red-600 text-white px-4 py-2 rounded text-sm">
                    Register
                </a>
            @endauth
        </div>

    </div>
</header>
