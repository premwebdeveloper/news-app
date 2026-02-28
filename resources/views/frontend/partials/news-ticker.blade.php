@if(isset($breakingNews) && $breakingNews->isNotEmpty())
<div class="news-ticker-bar bg-danger text-white py-2 overflow-hidden">
    <div class="container-fluid px-0">
        <div class="d-flex align-items-center">
            <span class="ticker-label px-3 py-1 bg-dark text-uppercase small fw-bold flex-shrink-0">
                Breaking News
            </span>
            <div class="ticker-wrap flex-grow-1 overflow-hidden">
                <div class="ticker-content">
                    @php $tickerItems = $breakingNews; @endphp
                    @foreach([1, 2] as $loopNum)
                        @foreach($tickerItems as $post)
                            <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}"
                               class="ticker-item text-white text-decoration-none me-5">
                                {{ \Illuminate\Support\Str::limit($post->title, 80) }}
                            </a>
                            <span class="text-white-50 me-5">|</span>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.news-ticker-bar { border-bottom: 1px solid rgba(0,0,0,0.1); }
.ticker-wrap { overflow: hidden; }
.ticker-content {
    display: inline-flex;
    white-space: nowrap;
    animation: ticker-scroll 50s linear infinite;
}
.ticker-content:hover { animation-play-state: paused; }
.ticker-item:hover { text-decoration: underline !important; }
@keyframes ticker-scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>
@endif
