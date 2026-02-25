<footer class="bg-dark text-white mt-5 pt-4">
    <div class="container pb-3">
        <div class="row g-4">

            {{-- About --}}
            <div class="col-12 col-md-4">
                <h4 class="fw-bold mb-2">News Blog</h4>
                <p class="small text-secondary mb-0">
                    Latest news from politics, sports, technology and entertainment.
                </p>
            </div>

            {{-- Dynamic Categories --}}
            <div class="col-12 col-md-4">
                <h4 class="fw-bold mb-2">Categories</h4>
                <ul class="list-unstyled small mb-0">
                    @foreach($menuCategories as $cat)
                        <li class="mb-1">
                            <a href="{{ route('category.show', $cat->slug) }}"
                               class="text-secondary text-decoration-none">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Social --}}
            <div class="col-12 col-md-4">
                <h4 class="fw-bold mb-2">Follow Us</h4>
                <p class="small text-secondary mb-0">
                    Facebook • Twitter • Instagram
                </p>
            </div>
        </div>
    </div>

    <div class="border-top border-secondary text-center text-secondary small py-3">
        © {{ date('Y') }} Panchayat 365. All rights reserved.
    </div>
</footer>
