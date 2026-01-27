@props(['tour'])

@if (isset($tour))
    @php
        $allImages = collect([$tour->thumbnail])
            ->concat($tour->images ?? [])
            ->filter()
            ->unique()
            ->values();
        $imagesJson = $allImages->toJson();
    @endphp

    @if ($allImages->isNotEmpty())
        <div x-data="{
            lightboxOpen: false,
            currentIndex: 0,
            images: {{ $imagesJson }},
            get isFirst() { return this.currentIndex === 0 },
            get isLast() { return this.currentIndex === this.images.length - 1 },
            next() { this.currentIndex = (this.currentIndex + 1) % this.images.length },
            prev() { this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length },
            openLightbox(index) { this.currentIndex = index;
                this.lightboxOpen = true;
                document.body.style.overflow = 'hidden'; },
            closeLightbox() { this.lightboxOpen = false;
                document.body.style.overflow = ''; }
        }" @keydown.escape.window="closeLightbox()"
            @keydown.arrow-right.window="lightboxOpen && next()" @keydown.arrow-left.window="lightboxOpen && prev()">

            {{-- Main Gallery Swiper --}}
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                class="swiper gallery-top rounded-xl shadow-lg overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($allImages as $index => $image)
                        <div class="swiper-slide bg-gray-100">
                            <button @click="openLightbox({{ $index }})"
                                class="block h-full w-full focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:ring-offset-2">
                                <img src="{{ $image }}"
                                    alt="Ảnh tour {{ $tour->name ?? '' }} - {{ $index + 1 }}"
                                    class="w-full h-full object-cover"
                                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}" />
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                {{-- Image Counter Badge --}}
                <div
                    class="absolute bottom-4 right-4 bg-black/60 text-white text-sm px-3 py-1.5 rounded-full z-10 flex items-center gap-1.5">
                    <i class="fa-regular fa-images"></i>
                    <span>{{ $allImages->count() }} ảnh</span>
                </div>
            </div>

            {{-- Thumbnails Swiper --}}
            <div thumbsSlider="" class="swiper gallery-thumbs mt-3">
                <div class="swiper-wrapper">
                    @foreach ($allImages as $index => $image)
                        <div
                            class="swiper-slide rounded-lg overflow-hidden border-2 border-transparent cursor-pointer hover:opacity-80 transition-opacity">
                            <img src="{{ $image }}" alt="Thumbnail tour {{ $tour->name ?? '' }}"
                                class="w-full h-full object-cover" loading="lazy" />
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Lightbox Modal --}}
            <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center" style="display: none;"
                role="dialog" aria-modal="true" aria-label="Xem ảnh tour">

                {{-- Close Button --}}
                <button @click="closeLightbox()"
                    class="absolute top-4 right-4 text-white w-12 h-12 flex items-center justify-center hover:bg-white/10 rounded-full transition-colors z-20"
                    aria-label="Đóng">
                    <i class="fa-solid fa-xmark text-2xl"></i>
                </button>

                {{-- Previous Button --}}
                <button @click="prev()"
                    class="absolute left-4 md:left-8 text-white w-12 h-12 md:w-14 md:h-14 flex items-center justify-center hover:bg-white/10 rounded-full transition-colors z-20"
                    :class="{ 'opacity-50': isFirst }" aria-label="Ảnh trước">
                    <i class="fa-solid fa-chevron-left text-2xl"></i>
                </button>

                {{-- Image Container --}}
                <div class="max-w-6xl max-h-[85vh] px-16 md:px-24">
                    <template x-for="(img, index) in images" :key="index">
                        <img x-show="currentIndex === index" :src="img"
                            class="max-h-[80vh] max-w-full rounded-lg shadow-2xl object-contain"
                            :alt="'Ảnh tour ' + (index + 1)">
                    </template>
                </div>

                {{-- Next Button --}}
                <button @click="next()"
                    class="absolute right-4 md:right-8 text-white w-12 h-12 md:w-14 md:h-14 flex items-center justify-center hover:bg-white/10 rounded-full transition-colors z-20"
                    :class="{ 'opacity-50': isLast }" aria-label="Ảnh tiếp">
                    <i class="fa-solid fa-chevron-right text-2xl"></i>
                </button>

                {{-- Image Counter --}}
                <div
                    class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white font-medium bg-black/50 px-4 py-2 rounded-full">
                    <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                </div>

                {{-- Thumbnail Strip at Bottom --}}
                <div
                    class="absolute bottom-20 left-1/2 -translate-x-1/2 hidden md:flex gap-2 overflow-x-auto max-w-xl px-4">
                    <template x-for="(img, index) in images" :key="'thumb-' + index">
                        <button @click="currentIndex = index"
                            class="w-16 h-12 rounded-lg overflow-hidden shrink-0 border-2 transition-all"
                            :class="currentIndex === index ? 'border-white scale-110' :
                                'border-transparent opacity-60 hover:opacity-100'">
                            <img :src="img" class="w-full h-full object-cover"
                                :alt="'Thumbnail ' + (index + 1)">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    @else
        <div
            class="rounded-xl overflow-hidden shadow-lg h-[500px] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
            <div class="text-center text-gray-400">
                <i class="fa-regular fa-image text-6xl mb-4"></i>
                <p>Chưa có ảnh cho tour này</p>
            </div>
        </div>
    @endif
@endif
