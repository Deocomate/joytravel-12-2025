@extends('client.layouts.app')

@section('title', $tour->name ?? 'Chi tiết Tour')
@section('description',
    $tour->short_description ??
    'Khám phá chi tiết tour du lịch hấp dẫn với lịch trình đầy đủ, dịch
    vụ bao gồm và những điểm nhấn không thể bỏ lỡ.')

@push('styles')
    <style>
        .gallery-top {
            height: 300px;
            width: 100%;
        }

        @media (min-width: 768px) {
            .gallery-top {
                height: 500px;
            }
        }

        .gallery-thumbs {
            height: 80px;
            box-sizing: border-box;
            padding: 4px 0;
        }

        @media (min-width: 768px) {
            .gallery-thumbs {
                height: 100px;
                padding: 10px 0;
            }
        }

        .gallery-thumbs .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.5;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .gallery-thumbs .swiper-slide:hover {
            opacity: 0.8;
        }

        .gallery-thumbs .swiper-slide-thumb-active {
            opacity: 1;
            border-color: var(--color-primary) !important;
        }

        .tour-price-table th,
        .tour-price-table td {
            border: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
            text-align: left;
            vertical-align: middle;
        }

        .tour-price-table th {
            background-color: #f9fafb;
            font-weight: bold;
        }

        .prose-styles ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .prose-styles ol {
            list-style-type: decimal;
            padding-left: 20px;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .prose-styles p {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }

        .prose-styles h1,
        .prose-styles h2,
        .prose-styles h3,
        .prose-styles h4 {
            font-weight: bold;
            margin-top: 1.2em;
            margin-bottom: 0.6em;
        }

        /* Safe area for iOS */
        .safe-area-bottom {
            padding-bottom: max(1rem, env(safe-area-inset-bottom));
        }

        /* Quick search overlay */
        .quick-search-overlay {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Share button effects */
        .share-btn {
            transition: all 0.2s ease;
        }

        .share-btn:hover {
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')
    {{-- Quick Search Modal --}}
    <div x-data="{ showSearch: false }" @keydown.escape.window="showSearch = false">
        {{-- Search Toggle Button (Fixed) --}}
        <button @click="showSearch = true"
            class="fixed bottom-24 right-4 lg:hidden z-40 w-14 h-14 bg-white rounded-full shadow-xl border border-gray-200 flex items-center justify-center text-[var(--color-primary)] hover:bg-[var(--color-primary)] hover:text-white transition-all"
            aria-label="Tìm tour khác">
            <i class="fa-solid fa-search text-lg"></i>
        </button>

        {{-- Search Overlay --}}
        <div x-show="showSearch" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/60 z-50 quick-search-overlay flex items-start justify-center pt-20 px-4"
            style="display: none;" @click.self="showSearch = false">

            <div x-show="showSearch" x-transition:enter="transition ease-out duration-200 delay-100"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">

                <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-gray-800">
                        <i class="fa-solid fa-search text-[var(--color-primary)] mr-2"></i>
                        Tìm tour khác
                    </h3>
                    <button @click="showSearch = false" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <i class="fa-solid fa-times text-gray-500"></i>
                    </button>
                </div>

                <form action="{{ route('client.tours') }}" method="GET" class="p-4 space-y-4">
                    <div class="relative">
                        <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" placeholder="Nhập tên tour bạn muốn tìm..."
                            class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent text-lg"
                            autofocus>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('client.tours') }}"
                            class="flex-1 py-3 text-center border border-gray-200 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                            Xem tất cả tour
                        </a>
                        <button type="submit"
                            class="flex-1 py-3 bg-[var(--color-primary)] text-white rounded-xl font-bold hover:bg-[var(--color-primary-dark)] transition-colors">
                            Tìm kiếm
                        </button>
                    </div>
                </form>

                {{-- Quick Category Links --}}
                @if ($tour->categories && $tour->categories->isNotEmpty())
                    <div class="p-4 pt-0">
                        <p class="text-sm text-gray-500 mb-2">Tour cùng danh mục:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tour->categories as $cat)
                                <a href="{{ route('client.tours', ['category' => $cat->slug]) }}"
                                    class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-full text-sm font-medium hover:bg-amber-100 transition-colors">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Add padding bottom for mobile bottom bar --}}
    <div class="bg-gray-50 pb-24 lg:pb-0">
        <div class="container mx-auto px-4 py-6 md:py-10">
            {{-- Breadcrumb with Back Button --}}
            <div class="flex items-center justify-between mb-6">
                <nav class="text-sm flex-1 min-w-0" aria-label="Breadcrumb">
                    <ol class="flex items-center gap-2 text-gray-500 flex-wrap">
                        <li><a href="{{ route('client.home') }}"
                                class="hover:text-[var(--color-primary)] transition-colors">Trang chủ</a></li>
                        <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                        <li><a href="{{ route('client.tours') }}"
                                class="hover:text-[var(--color-primary)] transition-colors">Tour du lịch</a></li>
                        @if ($tour->categories && $tour->categories->first())
                            <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                            <li>
                                <a href="{{ route('client.tours', ['category' => $tour->categories->first()->slug]) }}"
                                    class="hover:text-[var(--color-primary)] transition-colors">
                                    {{ $tour->categories->first()->name }}
                                </a>
                            </li>
                        @endif
                        <li class="hidden md:block"><i class="fa-solid fa-chevron-right text-xs"></i></li>
                        <li class="hidden md:block text-gray-800 font-medium truncate max-w-[250px]">{{ $tour->name ?? 'Chi tiết' }}</li>
                    </ol>
                </nav>

                {{-- Desktop Actions --}}
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('client.tours') }}"
                        class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-xl text-gray-600 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)] transition-all">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                        Quay lại
                    </a>

                    {{-- Share Buttons --}}
                    <div class="flex items-center gap-2">
                        <button onclick="navigator.share?.({title: '{{ $tour->name }}', url: window.location.href}) || copyToClipboard()"
                            class="share-btn w-10 h-10 flex items-center justify-center rounded-xl border border-gray-200 text-gray-500 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600"
                            title="Chia sẻ">
                            <i class="fa-solid fa-share-nodes"></i>
                        </button>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                            target="_blank"
                            class="share-btn w-10 h-10 flex items-center justify-center rounded-xl border border-gray-200 text-gray-500 hover:bg-blue-600 hover:border-blue-600 hover:text-white"
                            title="Chia sẻ Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Tour Header Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                    <div class="flex-1">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-gray-800 leading-tight mb-4">
                            {{ $tour->name ?? 'Tên tour đang cập nhật' }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-3 text-sm">
                            {{-- Tour Code --}}
                            <span class="inline-flex items-center gap-1.5 bg-gray-100 px-3 py-1.5 rounded-lg font-medium">
                                <i class="fa-solid fa-hashtag text-[var(--color-primary)]"></i>
                                {{ $tour->tour_code ?? 'N/A' }}
                            </span>

                            {{-- Duration --}}
                            @if ($tour->duration)
                                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg font-medium">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $tour->duration }}
                                </span>
                            @endif

                            {{-- Category --}}
                            @if ($tour->categories && $tour->categories->isNotEmpty())
                                <a href="{{ route('client.tours', ['category' => $tour->categories->first()->slug]) }}"
                                    class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 px-3 py-1.5 rounded-lg font-medium hover:bg-amber-100 transition-colors">
                                    <i class="fa-solid fa-tag"></i>
                                    {{ $tour->categories->first()->name }}
                                </a>
                            @endif

                            {{-- Destinations --}}
                            @if ($tour->destinations && $tour->destinations->isNotEmpty())
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1.5 rounded-lg font-medium">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                    {{ $tour->destinations->pluck('name')->join(', ') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Price Preview (Desktop) --}}
                    <div class="hidden lg:block text-right">
                        <p class="text-sm text-gray-500 mb-1">Giá từ</p>
                        <p class="text-3xl font-extrabold text-[var(--color-primary)]">
                            {{ number_format($tour->price_adult ?? 0, 0, ',', '.') }}đ
                        </p>
                        <p class="text-sm text-gray-500">/người lớn</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8">
                    @include('client.tours.partials._gallery', ['tour' => $tour])
                    @include('client.tours.partials._main_content', ['tour' => $tour])
                </div>

                <aside class="lg:col-span-4">
                    @include('client.tours.partials._sidebar', ['tour' => $tour])

                    {{-- Quick Navigation (Desktop) --}}
                    <div class="hidden lg:block sticky top-28 mt-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-compass text-[var(--color-primary)]"></i>
                                Điều hướng nhanh
                            </h4>
                            <nav class="space-y-2">
                                <a href="#schedule"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-[var(--color-primary)] transition-colors">
                                    <i class="fa-solid fa-calendar-days w-5 text-center"></i>
                                    Lịch trình
                                </a>
                                <a href="#services"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-[var(--color-primary)] transition-colors">
                                    <i class="fa-solid fa-concierge-bell w-5 text-center"></i>
                                    Dịch vụ bao gồm
                                </a>
                                <a href="#notes"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-[var(--color-primary)] transition-colors">
                                    <i class="fa-solid fa-info-circle w-5 text-center"></i>
                                    Lưu ý
                                </a>
                                <a href="#related-tours"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-[var(--color-primary)] transition-colors">
                                    <i class="fa-solid fa-th-large w-5 text-center"></i>
                                    Tour liên quan
                                </a>
                            </nav>
                        </div>

                        {{-- Search Another Tour --}}
                        <div class="mt-4 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-100 p-5">
                            <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-search text-[var(--color-primary)]"></i>
                                Tìm tour khác
                            </h4>
                            <form action="{{ route('client.tours') }}" method="GET">
                                <div class="relative mb-3">
                                    <input type="text" name="search" placeholder="Nhập tên tour..."
                                        class="w-full px-4 py-3 pl-10 border border-amber-200 rounded-xl focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent bg-white">
                                    <i class="fa-solid fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                </div>
                                <button type="submit"
                                    class="w-full py-3 bg-[var(--color-primary)] text-white font-bold rounded-xl hover:bg-[var(--color-primary-dark)] transition-colors">
                                    Tìm kiếm
                                </button>
                            </form>
                        </div>
                    </div>
                </aside>
            </div>

            <div id="related-tours">
                @include('client.tours.partials._related_tours', ['relatedTours' => $relatedTours])
            </div>
        </div>
    </div>

    {{-- Mobile Bottom Bar --}}
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 z-40 safe-area-bottom shadow-2xl">
        <div class="flex items-center gap-4">
            <div class="flex-1">
                <p class="text-xs text-gray-500">Giá từ</p>
                <p class="text-xl font-extrabold text-[var(--color-primary)]">
                    {{ number_format($tour->price_adult ?? 0, 0, ',', '.') }}đ
                </p>
            </div>
            <a href="{{ route('client.checkout', $tour->slug) }}"
                class="flex-1 bg-[var(--color-primary)] text-white font-bold py-4 px-6 rounded-xl text-center hover:bg-[var(--color-primary-dark)] transition-colors shadow-lg">
                Đặt Tour Ngay
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Copy to clipboard fallback
        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Đã sao chép liên kết!');
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Thumbnail Swiper
            const galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 10,
                slidesPerView: 5,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    320: {
                        slidesPerView: 3.5,
                        spaceBetween: 8
                    },
                    640: {
                        slidesPerView: 5,
                        spaceBetween: 10
                    },
                }
            });

            // Main Gallery Swiper
            const galleryTop = new Swiper('.gallery-top', {
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: galleryThumbs,
                },
            });

            // Related Tours Slider
            const relatedTourSlider = document.querySelector('.related-tours-slider-container .swiper.tour-slider');
            if (relatedTourSlider) {
                new Swiper(relatedTourSlider, {
                    slidesPerView: 1.15,
                    spaceBetween: 12,
                    navigation: {
                        nextEl: '.related-tours-slider-container .swiper-button-next',
                        prevEl: '.related-tours-slider-container .swiper-button-prev',
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2.2,
                            spaceBetween: 16
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 16
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 16
                        },
                    },
                });
            }

            // Schedule Accordion
            const scheduleItems = document.querySelectorAll('.schedule-item');
            scheduleItems.forEach(item => {
                const content = item.querySelector('.schedule-content');
                const toggle = item.querySelector('.schedule-toggle');
                const icon = item.querySelector('.schedule-icon');

                if (content) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
                if (icon) {
                    icon.classList.add('rotate-180');
                }

                if (toggle) {
                    toggle.addEventListener('click', () => {
                        const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
                        if (isOpen) {
                            content.style.maxHeight = '0px';
                            if (icon) icon.classList.remove('rotate-180');
                        } else {
                            content.style.maxHeight = content.scrollHeight + 'px';
                            if (icon) icon.classList.add('rotate-180');
                        }
                    });
                }
            });

            // Smooth scroll for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        const offset = 100;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - offset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endpush
