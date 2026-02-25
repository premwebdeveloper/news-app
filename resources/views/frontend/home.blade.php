@extends('frontend.layouts.app')

{{-- Home keeps the global default SEO title & description from layout --}}

@section('content')

@php
    $heroPost = $posts->first();
@endphp

@if($heroPost)
<section class="bg-white py-4">
    <div class="container">
        <div class="row g-4 align-items-center">

            <!-- Image -->
            <div class="col-12 col-md-6">
                <a href="{{ route('news.show', [
                                'category' => $heroPost->category->slug,
                                'slug' => $heroPost->slug
                            ]) }}">
                    <img
                        src="{{ $heroPost->image }}"
                        class="img-fluid rounded w-100"
                        style="max-height:350px;object-fit:cover;"
                        alt="{{ $heroPost->title }}"
                        title="{{ $heroPost->title }}">
                </a>
            </div>

            <!-- Content -->
            <div class="col-12 col-md-6">
                <span class="badge bg-danger">
                    {{ $heroPost->category->name }}
                </span>

                {{-- Main page title (single H1) --}}
                <h1 class="h2 fw-bold mt-3">
                    {{ $heroPost->title }}
                </h1>

                <p class="text-muted mt-2">
                    {{ Str::limit(strip_tags($heroPost->content), 150) }}
                </p>

                <a href="{{ route('news.show', [
                            'category' => $heroPost->category->slug,
                            'slug' => $heroPost->slug
                        ]) }}"
                   class="mt-3 d-inline-block text-danger fw-semibold text-decoration-none">
                    Read Full Story →
                </a>
            </div>

        </div>
    </div>
</section>
@endif

<!-- Latest News -->
<section class="py-4">
    <div class="container">
        <h2 class="h3 fw-bold mb-4 border-start border-4 border-danger ps-3">
            Latest News
        </h2>

        <div class="row g-4">

            @foreach($posts->skip(1) as $post)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100 shadow-sm border-0">

                    <a href="{{ route('news.show', [
                                'category' => $post->category->slug,
                                'slug' => $post->slug
                            ]) }}">
                        <img
                            src="{{ $post->image }}"
                            class="card-img-top"
                            style="height:190px;object-fit:cover;"
                            alt="{{ $post->title }}"
                            title="{{ $post->title }}">
                    </a>

                    <div class="card-body">
                        <span class="badge bg-light text-danger text-uppercase small mb-2">
                            {{ $post->category->name }}
                        </span>

                        <h3 class="h6 fw-bold">
                            <a href="{{ route('news.show', [
                                'category' => $post->category->slug,
                                'slug' => $post->slug
                            ]) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-muted small mt-2 mb-3">
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>

                        <a href="{{ route('news.show', [
                                'category' => $post->category->slug,
                                'slug' => $post->slug
                            ]) }}"
                           class="small fw-semibold text-danger text-decoration-none">
                            Read More →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>


<!-- Categories -->
<section class="py-5 bg-light">
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
</section>

@endsection