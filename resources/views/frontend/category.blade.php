@extends('frontend.layouts.app')

@section('title', $category->name.' News')

@section('content')

<section class="bg-white py-6">
    <div class="max-w-7xl mx-auto px-4">

        <h1 class="text-3xl font-bold mb-6 border-l-4 border-red-600 pl-3">
            {{ $category->name }}
        </h1>

        {{-- Posts Grid --}}
        <div class="grid md:grid-cols-3 gap-6" id="post-container">
            @include('frontend.partials.category-posts')
        </div>

        {{-- Trigger Div --}}
        <div id="load-trigger" class="h-10"></div>

        {{-- Loading --}}
        <div id="loading" class="text-center mt-6 hidden">
            Loading more posts...
        </div>

        {{-- Hidden Pagination for SEO --}}
        <div class="hidden">
            {{ $posts->links() }}
        </div>

    </div>
</section>

<script>
    let page = 2;
    let lastPage = {{ $posts->lastPage() }};
    let loading = false;

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting && !loading && page <= lastPage) {
            loadMore();
        }
    }, {
        rootMargin: "200px"
    });

    observer.observe(document.querySelector('#load-trigger'));

    function loadMore() {
        loading = true;
        document.getElementById('loading').classList.remove('hidden');

        fetch(`?page=${page}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('post-container')
                .insertAdjacentHTML('beforeend', data);

            page++;
            loading = false;

            document.getElementById('loading').classList.add('hidden');
        });
    }
</script>
@endsection
