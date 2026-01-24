<footer class="bg-black text-white mt-10">
    <div class="max-w-7xl mx-auto px-4 py-8 grid md:grid-cols-3 gap-6">

        {{-- About --}}
        <div>
            <h4 class="font-bold mb-2">News Blog</h4>
            <p class="text-sm text-gray-400">
                Latest news from politics, sports, technology and entertainment.
            </p>
        </div>

        {{-- Dynamic Categories --}}
        <div>
            <h4 class="font-bold mb-2">Categories</h4>
            <ul class="text-sm space-y-1 text-gray-400">
                @foreach($menuCategories as $cat)
                    <li>
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="hover:text-white transition">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Social --}}
        <div>
            <h4 class="font-bold mb-2">Follow Us</h4>
            <p class="text-sm text-gray-400">
                Facebook • Twitter • Instagram
            </p>
        </div>
    </div>

    <div class="text-center text-gray-500 text-sm border-t border-gray-700 py-3">
        © {{ date('Y') }} Panchayat 365. All rights reserved.
    </div>
</footer>
