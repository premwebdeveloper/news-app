@extends('frontend.layouts.app')

@section('title','News Detail')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow mt-6 rounded">

    <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c"
         class="w-full h-[400px] object-cover rounded">

    <h1 class="text-3xl font-bold mt-6">
        Big News Headline Goes Here
    </h1>

    <p class="text-gray-500 text-sm mt-2">
        Category • {{ date('d M Y') }}
    </p>

    <p class="mt-4 text-gray-700 leading-relaxed">
        This is the detailed news content. Later this will come from database.
        For now this is static design.
    </p>

</div>
@endsection
