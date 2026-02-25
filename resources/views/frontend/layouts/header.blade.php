<header class="bg-white shadow sticky-top z-50">
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2">
                <span class="px-2 py-1 fw-bold text-white" style="background-color:#dc2626;">Panchayat</span>
                <span class="fw-bold fs-4">365</span>
            </a>

            {{-- Navbar toggler (mobile) --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                {{-- Dynamic Menu --}}
                <ul class="navbar-nav me-auto mb-2 mb-md-0 fw-semibold">
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                           class="nav-link {{ request()->routeIs('home') ? 'text-danger' : '' }}">
                            Home
                        </a>
                    </li>

                    @foreach($menuCategories as $cat)
                        <li class="nav-item">
                            <a href="{{ route('category.show', $cat->slug) }}"
                               class="nav-link {{ request()->is('category/'.$cat->slug) ? 'text-danger' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- Auth Links --}}
                <div class="d-flex align-items-center gap-2">
                    @auth
                        <a href="/admin/dashboard" class="small fw-semibold text-decoration-none">
                            Dashboard
                        </a>
                    @else
                        <a href="/login" class="small fw-semibold text-decoration-none">
                            Login
                        </a>
                        <a href="/register" class="btn btn-danger btn-sm">
                            Register
                        </a>
                    @endauth
                </div>
            </div>

        </div>
    </nav>
</header>
