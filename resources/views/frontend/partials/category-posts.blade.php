@foreach($posts as $post)
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card h-100 shadow-sm border-0">

            <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                <img
                    src="{{ filter_var($post->image, FILTER_VALIDATE_URL) ? $post->image : asset('storage/'.$post->image) }}"
                    loading="lazy"
                    width="400"
                    height="250"
                    alt="{{ $post->title }}"
                    title="{{ $post->title }}"
                    class="card-img-top"
                    style="height:190px;object-fit:cover;">
            </a>

            <div class="card-body">
                <span class="badge bg-light text-danger text-uppercase small mb-2">
                    {{ $post->category->name }}
                </span>

                <h3 class="h6 fw-bold">
                    <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}"
                       class="text-decoration-none text-dark">
                        {{ $post->title }}
                    </a>
                </h3>

                <p class="text-muted small mt-2 mb-3">
                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                </p>

                <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}"
                   class="small fw-semibold text-danger text-decoration-none">
                    Read More →
                </a>
            </div>
        </div>
    </div>
@endforeach
