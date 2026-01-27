@if (isset($relatedTours) && $relatedTours->isNotEmpty())
    <section class="mt-12 md:mt-16">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 uppercase">Tour tương tự</h2>
            <a href="{{ route('client.tours') }}"
                class="hidden sm:flex items-center gap-2 text-[var(--color-primary)] hover:text-[var(--color-primary-dark)] font-medium transition-colors">
                Xem tất cả
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="relative slider-container related-tours-slider-container">
            <div class="swiper tour-slider">
                <div class="swiper-wrapper">
                    @foreach ($relatedTours as $relatedTour)
                        <div class="swiper-slide h-auto">
                            <x-client.tour-card :tour="$relatedTour" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next !hidden md:!flex"></div>
            <div class="swiper-button-prev !hidden md:!flex"></div>
        </div>
        {{-- Mobile "View All" button --}}
        <div class="mt-6 text-center sm:hidden">
            <a href="{{ route('client.tours') }}"
                class="inline-flex items-center gap-2 bg-[var(--color-primary)] text-white font-bold py-3 px-6 rounded-lg hover:bg-[var(--color-primary-dark)] transition-colors">
                Xem tất cả tour
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>
@endif
