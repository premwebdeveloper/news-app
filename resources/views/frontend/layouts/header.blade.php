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
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle small fw-semibold" href="#" id="userMenuDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuDropdown">
                                <li>
                                    @if(auth()->user()->role === 'admin')
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Dashboard
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            Dashboard
                                        </a>
                                    @endif
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="nav-link small fw-semibold">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-danger btn-sm">
                                Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </nav>
</header>
