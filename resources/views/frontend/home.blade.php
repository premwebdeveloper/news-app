@extends('frontend.layouts.app')

@section('title','Latest News')

@section('content')

@php
    $heroPost = $posts->first();
@endphp

<!-- Hero Section -->
<!-- Hero Section -->
@if($heroPost)
<section class="bg-white">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-6 p-6 items-center">

        <!-- Image -->
        <a href="{{ route('news.show', [
                        'category' => $heroPost->category->slug,
                        'slug' => $heroPost->slug
                    ]) }}">
            <img
                src="{{ $heroPost->image }}"
                class="rounded-lg w-full h-[350px] object-cover"
                alt="{{ $heroPost->title }}">
        </a>

        <!-- Content -->
        <div>
            <span class="bg-red-600 text-white px-3 py-1 text-sm rounded">
                {{ $heroPost->category->name }}
            </span>

            <h2 class="text-3xl font-bold mt-4 leading-tight">
                {{ $heroPost->title }}
            </h2>

            <p class="text-gray-600 mt-3">
                {{ Str::limit(strip_tags($heroPost->content), 150) }}
            </p>

            <a href="{{ route('news.show', [
                        'category' => $heroPost->category->slug,
                        'slug' => $heroPost->slug
                    ]) }}"
               class="inline-block mt-4 text-red-600 font-semibold">
                Read Full Story →
            </a>
        </div>

    </div>
</section>
@endif

<!-- Latest News -->
<section class="max-w-7xl mx-auto p-6">
    <h3 class="text-2xl font-bold mb-6 border-l-4 border-red-600 pl-3">
        Latest News
    </h3>

    <h1 style="color:red">LIVE TEST WORKING</h1>

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($posts->skip(1) as $post)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">

            <a href="{{ route('news.show', [
                        'category' => $post->category->slug,
                        'slug' => $post->slug
                    ]) }}">
                <img
                    src="{{ $post->image }}"
                    class="rounded-t-lg h-48 w-full object-cover"
                    alt="{{ $post->title }}">
            </a>

            <div class="p-4">
                <span class="text-xs text-red-600 font-semibold">
                    {{ $post->category->name }}
                </span>

                <h4 class="font-bold text-lg mt-2">
                    <a href="{{ route('news.show', [
                        'category' => $post->category->slug,
                        'slug' => $post->slug
                    ]) }}">
                        {{ $post->title }}
                    </a>

                </h4>

                <p class="text-gray-600 text-sm mt-2">
                    {{ Str::limit(strip_tags($post->content), 100) }}
                </p>

                <a href="{{ route('news.show', [
                        'category' => $post->category->slug,
                        'slug' => $post->slug
                    ]) }}"
                   class="text-red-600 mt-3 inline-block text-sm font-semibold">
                    Read More →
                </a>
            </div>
        </div>
        @endforeach

    </div>
</section>


<!-- Categories -->
<section class="bg-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-2xl font-bold mb-6">
            Browse by Category
        </h3>

        <div class="grid md:grid-cols-4 gap-4">
            @foreach($categories as $cat)
            <a href="{{ route('category.show', $cat->slug) }}"
               class="bg-white p-6 rounded shadow hover:bg-red-600 hover:text-white transition text-center font-semibold">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection