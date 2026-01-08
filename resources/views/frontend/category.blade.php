@extends('frontend.layouts.app')

@section('title','Category News')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 capitalize">
        {{ $category ?? 'Category' }} News
    </h1>

    <div class="grid md:grid-cols-3 gap-6">
        @for($i=1;$i<=6;$i++)
        <div class="bg-white shadow rounded">
            <img src="https://images.unsplash.com/photo-1495020689067-958852a7765e"
                 class="h-48 w-full object-cover rounded-t">
            <div class="p-4">
                <h3 class="font-bold">News Title {{ $i }}</h3>
                <a href="/news/sample-news" class="text-red-600 text-sm mt-2 inline-block">
                    Read More →
                </a>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
