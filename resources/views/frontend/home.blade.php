@extends('frontend.layouts.app')

{{-- Home keeps the global default SEO title & description from layout --}}

@section('content')

@php
    $heroPost = $posts->first();
    $rightPosts = $posts->take(5);
@endphp

@if($heroPost)
{{-- Hero section: left hero (dynamic) + right 4 posts (hero + next 3) --}}
<style>
.hero-card, .hero-side-card { transition: transform 0.3s ease; }
.hero-card:hover, .hero-side-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
.hero-card img, .hero-side-card img { transition: transform 0.5s ease, opacity 0.4s ease; }
.hero-card:hover img, .hero-side-card:hover img { transform: scale(1.08); opacity: 0.9; }
</style>

<section class="bg-white py-4">
    <div class="container">
        <div class="row g-3">

            {{-- Left: Main hero - image with content overlay --}}
            <div class="col-12 col-lg-6">
                <a href="{{ route('news.show', ['category' => $heroPost->category->slug, 'slug' => $heroPost->slug]) }}" class="text-decoration-none">
                    <div class="hero-card position-relative overflow-hidden rounded">
                        <img src="{{ $heroPost->image }}" alt="{{ $heroPost->title }}" title="{{ $heroPost->title }}" class="img-fluid w-100" style="height:450px;object-fit:cover;">
                        <div class="hero-overlay position-absolute bottom-0 start-0 end-0 p-3 p-md-4 text-white" style="background:linear-gradient(transparent,rgba(0,0,0,0.85));">
                            <span class="badge bg-danger mb-2">{{ $heroPost->category->name }}</span>
                            <h1 class="h3 fw-bold mb-2 text-white">{{ $heroPost->title }}</h1>
                            <p class="mb-2 small opacity-90 d-none d-md-block">{{ Str::limit(strip_tags($heroPost->content), 120) }}</p>
                            <span class="text-white fw-semibold small">Read Full Story →</span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Right: 4 posts in 2x2 grid - image with content overlay (same as left) --}}
            <div class="col-12 col-lg-6">
                <div class="row g-3">
                    @foreach($rightPosts->skip(1)->take(4) as $post)
                    <div class="col-6">
                        <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="text-decoration-none d-block h-100">
                            <div class="hero-side-card position-relative overflow-hidden rounded h-100" style="min-height:218px;">
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" title="{{ $post->title }}" class="img-fluid w-100 h-100" style="object-fit:cover;">
                                <div class="position-absolute bottom-0 start-0 end-0 p-2 text-white small" style="background:linear-gradient(transparent,rgba(0,0,0,0.85));">
                                    <span class="badge bg-danger mb-1">{{ $post->category->name }}</span>
                                    <div class="fw-semibold text-white">{{ Str::limit($post->title, 45) }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
@endif

{{-- Politics and sports news section --}}
<section class="py-4">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Latest News --}}
            <div class="col-12 col-lg-9">
                <h2 class="h3 fw-bold mb-4 border-start border-4 border-danger ps-3">
                    Politics News
                </h2>
                <div class="row g-4">
                    @foreach($politics as $post)
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                                <img src="{{ $post->image }}" class="card-img-top" style="height:190px;object-fit:cover;" alt="{{ $post->title }}" title="{{ $post->title }}">
                            </a>
                            <div class="card-body">
                                <span class="badge bg-light text-danger text-uppercase small mb-2">{{ $post->category->name }}</span>
                                <h3 class="h6 fw-bold">
                                    <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="text-decoration-none text-dark">{{ Str::limit($post->title, 60) }}</a>
                                </h3>
                                <p class="text-muted small mt-2 mb-3">{{ Str::limit(strip_tags($post->content), 80) }}</p>
                                <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="small fw-semibold text-danger text-decoration-none">Read More →</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Sports Posts --}}
            <div class="col-12 col-lg-3">
                <h2 class="h3 fw-bold mb-3 border-start border-4 border-danger ps-2">
                    Sports News
                </h2>
                <div class="d-flex flex-column gap-3">
                    @foreach($sports as $post)
                        <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="d-flex gap-2 text-decoration-none text-dark">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" title="{{ $post->title }}" class="rounded flex-shrink-0" style="width:90px;height:70px;object-fit:cover;">

                            <div>
                                <span class="badge bg-danger badge-sm mb-1">{{ $post->category->name }}</span>
                                <div class="small fw-semibold">{{ Str::limit($post->title, 60) }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- One single post highlight --}}
<section class="bg-white py-4">
    <div class="container">
        <div class="row g-4">

            <div class="col-12 col-lg-12">
                <!-- <h2 class="h3 fw-bold mb-4 border-start border-4 border-danger ps-3">
                    Latest News
                </h2> -->
                <div class="col-12 col-lg-12">
                    <a href="{{ route('news.show', ['category' => $business->category->slug, 'slug' => $business->slug]) }}" class="text-decoration-none">
                        <div class="hero-card position-relative overflow-hidden rounded">
                            <img src="{{ $business->image }}" alt="{{ $business->title }}" title="{{ $business->title }}" class="img-fluid w-100" style="height:450px;object-fit:cover;">
                            <div class="hero-overlay position-absolute bottom-0 start-0 end-0 p-3 p-md-4 text-white" style="background:linear-gradient(transparent,rgba(0,0,0,0.85));">
                                <span class="badge bg-danger mb-2">{{ $business->category->name }}</span>
                                <h1 class="h3 fw-bold mb-2 text-white">{{ $business->title }}</h1>
                                <p class="mb-2 small opacity-90 d-none d-md-block">{{ Str::limit(strip_tags($business->content), 120) }}</p>
                                <span class="text-white fw-semibold small">Read Full Story →</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Technology and Entertainment --}}
<section class="py-4">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Technology News --}}
            <div class="col-12 col-lg-9">
                <h2 class="h3 fw-bold mb-4 border-start border-4 border-danger ps-3">
                    Technology News
                </h2>
                <div class="row g-4">
                    @foreach($technology as $post)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card h-100 shadow-sm border-0">
                            <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                                <img src="{{ $post->image }}" class="card-img-top" style="height:190px;object-fit:cover;" alt="{{ $post->title }}" title="{{ $post->title }}">
                            </a>
                            <div class="card-body">
                                <span class="badge bg-light text-danger text-uppercase small mb-2">{{ $post->category->name }}</span>
                                <h3 class="h6 fw-bold">
                                    <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="text-decoration-none text-dark">{{ Str::limit($post->title, 60) }}</a>
                                </h3>
                                <p class="text-muted small mt-2 mb-3">{{ Str::limit(strip_tags($post->content), 80) }}</p>
                                <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="small fw-semibold text-danger text-decoration-none">Read More →</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Entertainment --}}
            <div class="col-12 col-lg-3">
                <h2 class="h3 fw-bold mb-3 border-start border-4 border-danger ps-2">
                    Entertainment News
                </h2>
                <div class="d-flex flex-column gap-3">
                    @foreach($entertainment as $post)
                        <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="d-flex gap-2 text-decoration-none text-dark">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" title="{{ $post->title }}" class="rounded flex-shrink-0" style="width:90px;height:70px;object-fit:cover;">

                            <div>
                                <span class="badge bg-danger badge-sm mb-1">{{ $post->category->name }}</span>
                                <div class="small fw-semibold">{{ Str::limit($post->title, 60) }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Business News --}}
<section class="py-4">
    <div class="container">
        <div class="row g-4">

            <div class="col-12 col-lg-12">
                <h2 class="h3 fw-bold mb-4 border-start border-4 border-danger ps-3">
                    Jobs News
                </h2>

                <div class="row g-4">
                    @foreach($jobs as $post)
                        <div class="col-12 col-lg-6">
                            <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" class="text-decoration-none">
                                <div class="hero-card position-relative overflow-hidden rounded">
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" title="{{ $post->title }}" class="img-fluid w-100" style="height:450px;object-fit:cover;">
                                    <div class="hero-overlay position-absolute bottom-0 start-0 end-0 p-3 p-md-4 text-white" style="background:linear-gradient(transparent,rgba(0,0,0,0.85));">
                                        <span class="badge bg-danger mb-2">{{ $post->category->name }}</span>
                                        <h1 class="h3 fw-bold mb-2 text-white">{{ $post->title }}</h1>
                                        <p class="mb-2 small opacity-90 d-none d-md-block">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                                        <span class="text-white fw-semibold small">Read Full Story →</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            

        </div>
    </div>
</section>

<!-- Categories -->
<!-- <section class="py-5 bg-light">
    <div class="container">
        <h2 class="h3 fw-bold mb-4">
            Browse by Category
        </h2>

        <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-4">
            @foreach($categories as $cat)
            <div class="col">
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="d-block text-center fw-semibold text-decoration-none text-dark bg-white rounded shadow-sm py-3 px-2 h-100">
                    {{ $cat->name }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section> -->

@endsection