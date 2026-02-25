@extends('frontend.layouts.app')

@section('title', $category->name.' News')

@section('content')

<section class="bg-white py-4">
    <div class="container">

        <h1 class="h3 fw-bold mb-4 border-start border-4 border-danger ps-3">
            {{ $category->name }}
        </h1>

        {{-- Posts Grid --}}
        <div class="row g-4" id="post-container">
            @include('frontend.partials.category-posts')
        </div>

        {{-- Trigger Div --}}
        <div id="load-trigger" style="height:40px;"></div>

        {{-- Loading --}}
        <div id="loading" class="text-center mt-3 d-none">
            Loading more posts...
        </div>

        {{-- Hidden Pagination for SEO --}}
        <div class="d-none">
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
        document.getElementById('loading').classList.remove('d-none');

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

            document.getElementById('loading').classList.add('d-none');
        });
    }
</script>
@endsection
