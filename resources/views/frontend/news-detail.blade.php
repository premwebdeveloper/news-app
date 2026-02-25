@extends('frontend.layouts.app')

@section('title', $post->seo->meta_title ?? $post->title)

@section('meta_description',
    $post->seo->meta_description
    ?? Str::limit(strip_tags($post->content), 150)
)

@section('content')

<section class="bg-white py-4">
    <div class="container" style="max-width: 860px;">

        {{-- Category + Date --}}
        <div class="mb-2 small text-muted">
            <a href="{{ route('category.show', $post->category->slug) }}"
               class="text-danger fw-semibold text-decoration-none">
                {{ $post->category->name }}
            </a>
            <span class="mx-1">|</span>
            <span>{{ $post->created_at->format('d M Y') }}</span>
        </div>

        {{-- Title --}}
        <h1 class="h2 h1-md fw-bold mb-3">
            {{ $post->title }}
        </h1>

        {{-- Featured Image --}}
        @if($post->image)
            <img
                src="{{ $post->image }}"
                alt="{{ $post->title }}"
                title="{{ $post->title }}"
                class="img-fluid rounded mb-4 w-100"
                style="object-fit:cover;"
            >
        @endif

        {{-- Content --}}
        <article class="mb-3">
            {!! $post->content !!}
        </article>

        @if($post->source_url)
            <a href="{{ $post->source_url }}" target="_blank" rel="nofollow noopener" class="btn btn-sm btn-info">
                पूरा लेख पढ़ें →
            </a>
        @endif

    </div>
</section>

@endsection
