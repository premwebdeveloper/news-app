@foreach($posts as $post)
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">

        <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
            <img 
                src="{{ $post->image }}"
                loading="lazy"
                width="400"
                height="250"
                alt="{{ $post->title }}"
                class="rounded-t-lg w-full object-cover h-48">
        </a>

        <div class="p-4">
            <span class="text-xs text-red-600 font-semibold">
                {{ $post->category->name }}
            </span>

            <h3 class="font-bold text-lg mt-2">
                <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                    {{ $post->title }}
                </a>
            </h3>

            <p class="text-gray-600 text-sm mt-2">
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
            </p>

            <a href="{{ route('news.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}"
               class="text-red-600 mt-3 inline-block text-sm font-semibold">
                Read More →
            </a>
        </div>
    </div>
@endforeach
