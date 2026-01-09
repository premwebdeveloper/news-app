@extends('frontend.layouts.app')

@section('title', $category->name.' News')

@section('content')

<section class="bg-white py-6">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Category Title --}}
        <h1 class="text-3xl font-bold mb-6 border-l-4 border-red-600 pl-3">
            {{ $category->name }}
        </h1>

        {{-- Posts Grid --}}
        <div class="grid md:grid-cols-3 gap-6">

            @forelse($posts as $post)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">

                    <a href="{{ route('news.show', [
                            'category' => $category->slug,
                            'slug' => $post->slug
                        ]) }}">
                        <img
                            src="{{ $post->image }}"
                            alt="{{ $post->title }}"
                            class="rounded-t-lg h-48 w-full object-cover"
                        >
                    </a>

                    <div class="p-4">
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $category->name }}
                        </span>

                        <h3 class="font-bold text-lg mt-2">
                            <a href="{{ route('news.show', [
                                    'category' => $category->slug,
                                    'slug' => $post->slug
                                ]) }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-gray-600 text-sm mt-2">
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>

                        <a href="{{ route('news.show', [
                                'category' => $category->slug,
                                'slug' => $post->slug
                            ]) }}"
                           class="text-red-600 mt-3 inline-block text-sm font-semibold">
                            Read More →
                        </a>
                    </div>
                </div>
            @empty
                <p>No posts found in this category.</p>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $posts->links() }}
        </div>

    </div>
</section>

@endsection
