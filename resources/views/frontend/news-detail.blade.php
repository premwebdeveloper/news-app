@extends('frontend.layouts.app')

@section('title', $post->seo->meta_title ?? $post->title)

@section('meta_description',
    $post->seo->meta_description
    ?? Str::limit(strip_tags($post->content), 150)
)

@section('content')

<section class="bg-white py-6">
    <div class="max-w-5xl mx-auto px-4">

        {{-- Category + Date --}}
        <div class="mb-3 text-sm text-gray-500">
            <a href="{{ route('category.show', $post->category->slug) }}"
               class="text-red-600 font-semibold">
                {{ $post->category->name }}
            </a>
            <span class="mx-2">|</span>
            <span>{{ $post->created_at->format('d M Y') }}</span>
        </div>

        {{-- Title --}}
        <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">
            {{ $post->title }}
        </h1>

        {{-- Featured Image --}}
        @if($post->image)
            <img
                src="{{ $post->image }}"
                alt="{{ $post->title }}"
                class="w-full rounded-lg mb-6 object-cover"
            >
        @endif

        {{-- Content --}}
        <article class="prose max-w-none">
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
