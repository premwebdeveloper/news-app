@extends('frontend.layouts.app')

{{-- Dynamic SEO for news detail: use post title for both --}}
@section('seo_title', $post->title)

@section('meta_description', $post->title)

@section('content')

<style>
    .share-container {
        display: flex;
        gap: 12px;
        margin-top: 15px;
    }

    .share-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        text-decoration: none;
        transition: 0.3s ease;
    }

    .share-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    /* Platform Colors */
    .facebook { background: #1877f2; }
    .twitter { background: #000000; }
    .whatsapp { background: #25d366; }
    .linkedin { background: #0077b5; }
</style>

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

        {{-- Like + Share row (stacked on mobile, side‑by‑side on desktop) --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mt-3">
            <!-- This is to show the like button -->
            <div>
                <livewire:post.like-button :post="$post" :key="$post->id" />
            </div>

            <div>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

                <div class="share-container">
                    <a target="_blank"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', ['category'=>$post->category->slug, 'slug'=>$post->slug])) }}"
                    class="share-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a target="_blank"
                    href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(route('news.show', ['category'=>$post->category->slug, 'slug'=>$post->slug])) }}"
                    class="share-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </a>

                    <a target="_blank"
                    href="https://wa.me/?text={{ urlencode($post->title.' '.route('news.show', ['category'=>$post->category->slug, 'slug'=>$post->slug])) }}"
                    class="share-btn whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a target="_blank"
                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('news.show', ['category'=>$post->category->slug, 'slug'=>$post->slug])) }}"
                    class="share-btn linkedin">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
