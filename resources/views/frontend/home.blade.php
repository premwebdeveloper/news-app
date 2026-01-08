@extends('frontend.layouts.app')

@section('title','Latest News')

@section('content')

<!-- Hero Section -->
<section class="bg-white">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-6 p-6 items-center">

        <!-- Image -->
        <img
            src="https://images.unsplash.com/photo-1504711434969-e33886168f5c"
            class="rounded-lg w-full h-[350px] object-cover"
            alt="Breaking News">

        <!-- Content -->
        <div>
            <span class="bg-red-600 text-white px-3 py-1 text-sm rounded">
                Breaking News
            </span>
            <h2 class="text-3xl font-bold mt-4 leading-tight">
                Major Political Update Shakes the Country
            </h2>
            <p class="text-gray-600 mt-3">
                This is a short description of the breaking news headline.
                Later this will come dynamically from database.
            </p>
            <a href="#" class="inline-block mt-4 text-red-600 font-semibold">
                Read Full Story →
            </a>
        </div>
    </div>
</section>

<!-- Latest News -->
<section class="max-w-7xl mx-auto p-6">
    <h3 class="text-2xl font-bold mb-6 border-l-4 border-red-600 pl-3">
        Latest News
    </h3>

    <div class="grid md:grid-cols-3 gap-6">

        @for($i=1;$i<=6;$i++)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">

            <img
                src="https://images.unsplash.com/photo-1495020689067-958852a7765e"
                class="rounded-t-lg h-48 w-full object-cover"
                alt="News">

            <div class="p-4">
                <span class="text-xs text-red-600 font-semibold">Politics</span>
                <h4 class="font-bold text-lg mt-2">
                    News Headline {{ $i }}
                </h4>
                <p class="text-gray-600 text-sm mt-2">
                    Short summary of the news article goes here.
                </p>
                <a href="#" class="text-red-600 mt-3 inline-block text-sm font-semibold">
                    Read More →
                </a>
            </div>
        </div>
        @endfor

    </div>
</section>

<!-- Categories -->
<section class="bg-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-2xl font-bold mb-6">Browse by Category</h3>

        <div class="grid md:grid-cols-4 gap-4">
            @foreach(['Politics','Sports','Technology','Entertainment'] as $cat)
            <div class="bg-white p-6 rounded shadow hover:bg-red-600 hover:text-white transition text-center font-semibold">
                {{ $cat }}
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
