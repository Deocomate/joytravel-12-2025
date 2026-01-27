@extends('client.layouts.app')

@section('title', 'Trang chủ - King Express Travel')
@section('description',
    'Khám phá các tour du lịch hấp dẫn trong và ngoài nước với giá tốt nhất. King Express Travel,
    đồng hành cùng bạn trên mọi nẻo đường.')

    @php
        // Static data for homepage - moved from controller
        $heroTypingPhrases = [
            'Khám phá Việt Nam tươi đẹp',
            'Du lịch 5 sao - Giá bình dân',
            'Trải nghiệm hành trình đáng nhớ',
            'Đồng hành cùng bạn mọi nẻo đường',
        ];

        $features = [
            [
                'icon' => 'fa-solid fa-earth-americas',
                'title' => 'Đa dạng tour',
                'description' => 'Hàng trăm tour trong và ngoài nước',
                'color' => 'blue',
            ],
            [
                'icon' => 'fa-solid fa-tags',
                'title' => 'Giá tốt nhất',
                'description' => 'Cam kết giá cạnh tranh nhất thị trường',
                'color' => 'green',
            ],
            [
                'icon' => 'fa-solid fa-headset',
                'title' => 'Hỗ trợ 24/7',
                'description' => 'Đội ngũ tư vấn viên nhiệt tình, chuyên nghiệp',
                'color' => 'purple',
            ],
            [
                'icon' => 'fa-solid fa-star',
                'title' => 'Dịch vụ 5 sao',
                'description' => 'Chất lượng dịch vụ hàng đầu',
                'color' => 'amber',
            ],
        ];

        $testimonials = [
            [
                'name' => 'Nguyễn Thị Hương',
                'avatar' => null,
                'rating' => 5,
                'comment' => 'Dịch vụ tuyệt vời, hướng dẫn viên nhiệt tình. Chắc chắn sẽ quay lại!',
                'tour' => 'Du lịch Ninh Bình 2N1Đ',
                'verified' => true,
            ],
            [
                'name' => 'Trần Minh Tuấn',
                'avatar' => null,
                'rating' => 5,
                'comment' => 'Giá cả hợp lý, tour được tổ chức rất chuyên nghiệp. Tôi rất hài lòng.',
                'tour' => 'Khám phá Hạ Long',
                'verified' => true,
            ],
            [
                'name' => 'Lê Thanh Hà',
                'avatar' => null,
                'rating' => 5,
                'comment' => 'Lần đầu đi tour mà ấn tượng quá. Cảm ơn King Express đã hỗ trợ chu đáo!',
                'tour' => 'Tour Huế - Đà Nẵng',
                'verified' => true,
            ],
        ];

        // Static destinations data
        $staticDestinations = [
            [
                'name' => 'Hạ Long',
                'slug' => 'ha-long',
                'thumbnail' => 'client/images/cities/quangninh/halongbay.webp',
                'tours_count' => 15,
                'min_price' => 1590000,
            ],
            [
                'name' => 'Ninh Bình',
                'slug' => 'ninh-binh',
                'thumbnail' => 'client/images/cities/ninhbinh/trangan.jpg',
                'tours_count' => 12,
                'min_price' => 990000,
            ],
            [
                'name' => 'Huế',
                'slug' => 'hue',
                'thumbnail' => 'client/images/cities/hue/kinhthanh.jpg',
                'tours_count' => 8,
                'min_price' => 2490000,
            ],
            [
                'name' => 'Hà Nội',
                'slug' => 'ha-noi',
                'thumbnail' => 'client/images/cities/hanoi/tp.jpg',
                'tours_count' => 20,
                'min_price' => 890000,
            ],
            [
                'name' => 'Hồ Chí Minh',
                'slug' => 'ho-chi-minh',
                'thumbnail' => 'client/images/cities/hochiminh/tphcm.jpg',
                'tours_count' => 18,
                'min_price' => 1290000,
            ],
            [
                'name' => 'Thanh Hóa',
                'slug' => 'thanh-hoa',
                'thumbnail' => 'client/images/cities/thanhhoa/th bien.jpg',
                'tours_count' => 5,
                'min_price' => 790000,
            ],
        ];

        // Destination placeholder images
        $destinationImages = [
            'da-lat' => '/userfiles/files/destinations/da-lat.jpg',
            'nha-trang' => '/userfiles/files/destinations/nha-trang.jpg',
            'phu-quoc' => '/userfiles/files/destinations/phu-quoc.jpg',
            'ha-long' => '/userfiles/files/destinations/ha-long.jpg',
            'sapa' => '/userfiles/files/destinations/sapa.jpg',
            'hoi-an' => '/userfiles/files/destinations/hoi-an.jpg',
        ];
    @endphp

@section('content')
    {{-- ==================== HERO SECTION ==================== --}}
    <section
        class="hero-section relative min-h-[85vh] md:min-h-[100vh] flex items-center justify-center overflow-visible z-50 pb-16 md:pb-24">
        {{-- Background Slider --}}
        <div class="absolute inset-0 z-0">
            <div class="swiper hero-slider h-full w-full">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="absolute inset-0 bg-cover bg-center transform scale-110 transition-transform duration-[8000ms]"
                            style="background-image: url('{{ asset('client/images/cities/quangninh/halongbay.webp') }}')">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70 z-10"></div>
            {{-- Animated particles --}}
            <div class="absolute inset-0 z-20 overflow-hidden pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
                <div class="particle particle-4"></div>
                <div class="particle particle-5"></div>
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-30 container mx-auto px-4 text-center pt-20 md:pt-24 lg:pt-28 overflow-visible">
            <div class="hero-content max-w-4xl mx-auto overflow-visible">
                {{-- Trust Badge with Dynamic Booking Count --}}
                <div class="hero-badge inline-flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-4 md:mb-6"
                    x-data="{ count: {{ $statistics['recent_bookings'] ?? 15 }} }" x-init="setInterval(() => { if (Math.random() > 0.7) count++ }, 30000)">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-xs md:text-sm font-medium">
                        <i class="fa-solid fa-fire-flame-curved text-orange-400 mr-1"></i>
                        <span x-text="count"></span>+ người đã đặt tour hôm nay
                    </span>
                </div>

                {{-- Main Title --}}
                <h1
                    class="hero-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black text-white mb-4 md:mb-6 leading-tight">
                    <span class="block">King Express</span>
                    <span class="gradient-text-hero">Travel</span>
                </h1>

                {{-- Typing Text --}}
                <div
                    class="hero-typing text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl text-white/90 font-medium mb-6 md:mb-8 h-8 md:h-10 lg:h-12">
                    <span id="typed-text"></span>
                </div>

                {{-- Description --}}
                <p
                    class="hero-description text-sm md:text-base lg:text-lg text-white/80 max-w-2xl mx-auto mb-6 md:mb-8 lg:mb-10 px-2">
                    Chúng tôi mang đến những trải nghiệm du lịch tuyệt vời nhất với dịch vụ chất lượng cao và giá cả phải
                    chăng.
                </p>

                {{-- CTA Buttons --}}
                <div class="hero-cta flex flex-col sm:flex-row gap-3 md:gap-4 justify-center items-center mb-8 md:mb-12">
                    <a href="{{ route('client.tours') }}"
                        class="group relative w-full sm:w-auto px-6 md:px-8 py-3 md:py-4 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-xl md:rounded-2xl overflow-hidden transform hover:scale-105 transition-all duration-300 shadow-lg shadow-primary/30">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                            Khám phá ngay
                        </span>
                        <div
                            class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700">
                        </div>
                    </a>
                    <a href="{{ route('client.contact') }}"
                        class="w-full sm:w-auto px-6 md:px-8 py-3 md:py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-xl md:rounded-2xl border-2 border-white/30 hover:bg-white hover:text-gray-900 transition-all duration-300">
                        <i class="fa-solid fa-phone-volume mr-2"></i>
                        Liên hệ tư vấn
                    </a>
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="hero-search max-w-4xl mx-auto relative z-40 overflow-visible">
                <x-client.tour-search-bar variant="hero" />
            </div>
        </div>

        {{-- Floating Elements --}}
        <div class="floating-elements absolute inset-0 z-20 pointer-events-none overflow-hidden hidden lg:block">
            <div class="floating-plane absolute top-1/4 left-10 text-white/20 text-4xl lg:text-6xl animate-float">
                <i class="fa-solid fa-plane"></i>
            </div>
            <div class="floating-globe absolute top-1/3 right-16 text-white/15 text-5xl lg:text-8xl animate-float-slow">
                <i class="fa-solid fa-earth-asia"></i>
            </div>
            <div class="floating-compass absolute bottom-1/3 left-1/4 text-white/10 text-3xl lg:text-5xl animate-float"
                style="animation-delay: 1s;">
                <i class="fa-solid fa-compass"></i>
            </div>
        </div>
    </section>

    {{-- Mobile Search (visible on mobile only) --}}
    <section class="md:hidden px-4 py-3 bg-gray-50 relative z-40 overflow-visible">
        <x-client.tour-search-bar variant="mobile" />
    </section>

    {{-- ==================== WHY CHOOSE US SECTION ==================== --}}
    <section class="py-10 md:py-14 lg:py-20 bg-white relative overflow-visible z-10">
        {{-- Subtle Background --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
            <div class="absolute top-0 left-0 w-72 h-72 bg-primary rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-400 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-8 md:mb-10" data-aos="fade-up">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary/10 text-primary font-semibold rounded-full text-xs mb-3">
                    <i class="fa-solid fa-shield-check"></i> Tại sao chọn chúng tôi
                </span>
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-900 mb-2">
                    Đồng Hành Cùng <span class="gradient-text">King Express</span>
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto text-sm md:text-base">
                    Nhiều năm kinh nghiệm, mang đến trải nghiệm du lịch hoàn hảo
                </p>
            </div>

            {{-- Features Grid --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 lg:gap-6">
                @foreach ($features as $index => $feature)
                    <div class="feature-card group p-4 md:p-5 bg-white rounded-xl md:rounded-2xl border border-gray-100 hover:border-{{ $feature['color'] }}-200 hover:shadow-lg transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ min($index * 75, 225) }}">
                        {{-- Icon --}}
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-{{ $feature['color'] }}-50 flex items-center justify-center mb-3 md:mb-4 group-hover:scale-105 transition-transform">
                            <i class="{{ $feature['icon'] }} text-lg md:text-xl text-{{ $feature['color'] }}-500"></i>
                        </div>
                        {{-- Content --}}
                        <h3 class="text-sm md:text-base font-bold text-gray-800 mb-1">{{ $feature['title'] }}</h3>
                        <p class="text-gray-500 text-xs md:text-sm leading-relaxed">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== STATISTICS SECTION ==================== --}}
    <section id="stats-section" class="py-10 md:py-12 lg:py-16 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @php
                    $stats = [
                        ['icon' => 'fa-route', 'count' => $statistics['total_tours'] ?? 50, 'label' => 'Tour du lịch', 'gradient' => 'from-primary to-amber-400'],
                        ['icon' => 'fa-location-dot', 'count' => $statistics['total_destinations'] ?? 30, 'label' => 'Điểm đến', 'gradient' => 'from-blue-500 to-cyan-400'],
                        ['icon' => 'fa-users', 'count' => ($statistics['total_customers'] ?? 0) + 1000, 'label' => 'Khách hàng', 'gradient' => 'from-green-500 to-emerald-400'],
                        ['icon' => 'fa-award', 'count' => $statistics['years_experience'] ?? 10, 'label' => 'Năm kinh nghiệm', 'gradient' => 'from-purple-500 to-pink-400'],
                    ];
                @endphp

                @foreach ($stats as $index => $stat)
                    <div class="text-center py-4" data-aos="fade-up" data-aos-delay="{{ $index * 75 }}">
                        <div class="inline-flex items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full bg-gradient-to-br {{ $stat['gradient'] }} mb-3">
                            <i class="fa-solid {{ $stat['icon'] }} text-lg md:text-xl text-white"></i>
                        </div>
                        <div class="text-2xl md:text-3xl lg:text-4xl font-black text-white mb-1">
                            <span class="stat-number" data-count="{{ $stat['count'] }}">0</span>+
                        </div>
                        <p class="text-gray-400 font-medium text-xs md:text-sm">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Wave Separator --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60L60 55C120 50 240 40 360 35C480 30 600 30 720 32.5C840 35 960 40 1080 42.5C1200 45 1320 45 1380 45L1440 45V60H0Z" fill="#f9fafb"/>
            </svg>
        </div>
    </section>

    {{-- ==================== POPULAR DESTINATIONS SECTION ==================== --}}
    <section class="py-10 md:py-14 lg:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-6 md:mb-10" data-aos="fade-up">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-600 font-semibold rounded-full text-xs mb-3">
                    <i class="fa-solid fa-compass"></i> Điểm đến phổ biến
                </span>
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-900 mb-2">
                    Khám Phá <span class="gradient-text">Điểm Đến</span> Yêu Thích
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto text-sm md:text-base">
                    Những điểm đến được du khách yêu thích nhất
                </p>
            </div>

            {{-- Destinations Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
                @foreach ($staticDestinations as $index => $destination)
                    <a href="{{ route('client.tours', ['destination' => $destination['slug']]) }}"
                        class="group relative aspect-[4/3] rounded-xl md:rounded-2xl overflow-hidden cursor-pointer border border-gray-200/50 hover:border-primary/30 transition-all duration-300 hover:shadow-xl {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : '' }}"
                        data-aos="fade-up" data-aos-delay="{{ min($index * 50, 200) }}"
                        aria-label="Xem tour {{ $destination['name'] }}">
                        {{-- Background Image --}}
                        <img src="{{ asset($destination['thumbnail']) }}" alt="{{ $destination['name'] }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy">

                        {{-- Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent group-hover:from-black/80 transition-all duration-300">
                        </div>

                        {{-- Content --}}
                        <div class="absolute bottom-0 left-0 right-0 p-3 md:p-4">
                            <h3
                                class="text-sm sm:text-base md:text-lg {{ $index === 0 ? 'lg:text-xl' : '' }} font-bold text-white mb-0.5 group-hover:text-primary-accent transition-colors">
                                {{ $destination['name'] }}
                            </h3>
                            <div class="flex items-center justify-between">
                                <p class="text-white/80 text-[11px] md:text-xs flex items-center gap-1">
                                    <i class="fa-solid fa-route text-primary-accent"></i>
                                    {{ $destination['tours_count'] }} tour
                                </p>
                                <p class="text-white/90 text-[11px] md:text-xs">
                                    Từ <span
                                        class="text-primary-accent font-bold">{{ number_format($destination['min_price'] ?? 1990000, 0, ',', '.') }}đ</span>
                                </p>
                            </div>
                        </div>

                        {{-- Hover Arrow --}}
                        <div
                            class="absolute top-2 md:top-3 right-2 md:right-3 w-7 h-7 md:w-8 md:h-8 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                            <i class="fa-solid fa-arrow-right text-white text-xs"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== FEATURED TOURS SECTION ==================== --}}
    @if (!empty($featuredTours) && $featuredTours->count() > 0)
        <section class="py-12 md:py-16 lg:py-20 bg-white">
            <div class="container mx-auto px-4">
                {{-- Section Header with Inline Navigation --}}
                <div class="flex items-end justify-between mb-6 md:mb-8" data-aos="fade-up">
                    <div>
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-primary/10 to-amber-100 text-primary-dark font-semibold rounded-full text-xs mb-3">
                            <i class="fa-solid fa-fire-flame-curved text-orange-500"></i> Tour nổi bật
                        </span>
                        <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-900">
                            Tour <span class="gradient-text">Hot</span> Nhất
                        </h2>
                    </div>
                    <div class="flex items-center gap-3">
                        {{-- Navigation Buttons in Header --}}
                        <div class="slider-header-nav hidden sm:flex" id="featured-tours-nav">
                            <button class="slider-nav-btn swiper-button-prev" aria-label="Tour trước"></button>
                            <button class="slider-nav-btn swiper-button-next" aria-label="Tour tiếp theo"></button>
                        </div>
                        <a href="{{ route('client.tours') }}"
                            class="hidden md:inline-flex items-center gap-2 px-4 py-2 bg-primary/10 hover:bg-primary text-primary hover:text-white font-semibold rounded-full transition-all duration-300 text-sm">
                            Xem tất cả
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                {{-- Tours Slider --}}
                <div class="relative slider-overflow-fix" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper featured-tours-slider" id="featured-tours-slider">
                        <div class="swiper-wrapper">
                            @foreach ($featuredTours as $tour)
                                <div class="swiper-slide">
                                    <x-client.tour-card :tour="$tour" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Mobile View All Link --}}
                <div class="mt-6 text-center md:hidden">
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-semibold rounded-full text-sm shadow-lg shadow-primary/30">
                        Xem tất cả tour
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== TOUR CATEGORIES SECTIONS ==================== --}}
    <div class="bg-gray-50 py-10 md:py-14 lg:py-20">
        <div class="container mx-auto px-4 space-y-10 md:space-y-12 lg:space-y-14">
            @if (!empty($tourCategories) && $tourCategories->isNotEmpty())
                @foreach ($tourCategories as $categoryIndex => $category)
                    @if ($category->tours->isNotEmpty())
                        <section data-aos="fade-up" data-aos-delay="{{ min($categoryIndex * 50, 150) }}">
                            {{-- Category Header with Navigation --}}
                            <div class="flex items-end justify-between mb-5 md:mb-6">
                                <div>
                                    <h2
                                        class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 flex items-center gap-2">
                                        <span
                                            class="w-1 h-5 md:h-6 bg-gradient-to-b from-primary to-amber-400 rounded-full"></span>
                                        {{ $category->name }}
                                    </h2>
                                </div>
                                {{-- Navigation Buttons --}}
                                <div class="slider-header-nav flex" id="cat-nav-{{ $categoryIndex }}">
                                    <button class="slider-nav-btn swiper-button-prev"
                                        aria-label="Danh mục trước"></button>
                                    <button class="slider-nav-btn swiper-button-next"
                                        aria-label="Danh mục tiếp theo"></button>
                                </div>
                            </div>

                            {{-- Tour Slider --}}
                            <div class="relative slider-overflow-fix">
                                <div class="swiper tour-slider" id="cat-slider-{{ $categoryIndex }}">
                                    <div class="swiper-wrapper">
                                        @foreach ($category->tours as $tour)
                                            <div class="swiper-slide">
                                                <x-client.tour-card :tour="$tour" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    {{-- ==================== ABOUT US BRIEF SECTION ==================== --}}
    <section class="py-10 md:py-14 lg:py-20 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8 md:gap-10 lg:gap-12 items-center">
                {{-- Image Side --}}
                <div class="relative" data-aos="fade-right">
                    <div class="relative z-10">
                        <img src="{{ asset('client/images/cities/ninhbinh/trangan.jpg') }}" alt="King Express Travel"
                            class="rounded-xl md:rounded-2xl shadow-xl w-full object-cover aspect-[4/3]">
                    </div>
                    {{-- Decorative Elements --}}
                    <div class="absolute -bottom-3 -right-3 md:-bottom-4 md:-right-4 w-32 md:w-48 h-32 md:h-48 bg-gradient-to-br from-primary/20 to-amber-200/20 rounded-xl md:rounded-2xl -z-10"></div>

                    {{-- Stats Badge --}}
                    <div class="absolute -bottom-2 left-3 md:left-6 bg-white rounded-xl shadow-lg p-3 md:p-4 z-20"
                        data-aos="zoom-in" data-aos-delay="200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center">
                                <i class="fa-solid fa-trophy text-white"></i>
                            </div>
                            <div>
                                <p class="text-xl font-black text-gray-900">{{ $statistics['years_experience'] ?? 10 }}+</p>
                                <p class="text-gray-500 text-xs">Năm kinh nghiệm</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Side --}}
                <div data-aos="fade-left">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary/10 text-primary font-semibold rounded-full text-xs mb-3">
                        <i class="fa-solid fa-building"></i> Về chúng tôi
                    </span>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900 mb-3 leading-tight">
                        Hành Trình Của Bạn,<br>
                        <span class="gradient-text">Đam Mê Của Chúng Tôi</span>
                    </h2>
                    <p class="text-gray-600 text-sm md:text-base mb-4 leading-relaxed">
                        King Express Travel tự hào là đơn vị lữ hành uy tín với nhiều năm kinh nghiệm.
                        Cam kết mang đến trải nghiệm du lịch tuyệt vời nhất với dịch vụ chất lượng và giá cả phải chăng.
                    </p>
                    <ul class="space-y-2 mb-5">
                        @foreach (['Đội ngũ hướng dẫn viên chuyên nghiệp, tận tâm', 'Lịch trình được thiết kế tối ưu, linh hoạt', 'Dịch vụ khách sạn, vận chuyển chất lượng cao'] as $item)
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-check text-green-600 text-[10px]"></i>
                                </span>
                                <span class="text-gray-700 text-sm">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('client.about') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-lg hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 text-sm">
                        Tìm hiểu thêm
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== TESTIMONIALS SECTION ==================== --}}
    <section class="py-10 md:py-14 lg:py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-6 md:mb-10" data-aos="fade-up">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 text-white font-semibold rounded-full text-xs mb-3 backdrop-blur-sm">
                    <i class="fa-solid fa-star text-yellow-400"></i> Đánh giá từ khách hàng
                </span>
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-white">
                    Khách Hàng <span class="text-primary">Nói Gì</span> Về Chúng Tôi
                </h2>
            </div>

            {{-- Testimonials Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
                @foreach ($testimonials as $index => $testimonial)
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 md:p-5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ min($index * 75, 150) }}">
                        {{-- Header: Rating + Quote --}}
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex gap-0.5">
                                @for ($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                @endfor
                            </div>
                            <i class="fa-solid fa-quote-right text-primary/20 text-xl"></i>
                        </div>

                        {{-- Comment --}}
                        <p class="text-white/80 mb-4 leading-relaxed text-sm">
                            "{{ $testimonial['comment'] }}"
                        </p>

                        {{-- Author --}}
                        <div class="flex items-center gap-3 pt-3 border-t border-white/10">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center text-white font-bold text-sm">
                                {{ mb_substr($testimonial['name'], 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-semibold text-sm flex items-center gap-1.5 truncate">
                                    {{ $testimonial['name'] }}
                                    @if ($testimonial['verified'] ?? false)
                                        <i class="fa-solid fa-badge-check text-blue-400 text-xs flex-shrink-0" title="Đã xác minh"></i>
                                    @endif
                                </p>
                                <p class="text-white/50 text-xs truncate">{{ $testimonial['tour'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CTA SECTION ==================== --}}
    <section class="py-10 md:py-12 lg:py-16 bg-gradient-to-r from-primary via-amber-500 to-primary-dark relative overflow-hidden">
        {{-- Subtle Pattern --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-2xl mx-auto text-center" data-aos="fade-up">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-white mb-3">
                    Sẵn Sàng Cho Chuyến Đi Tiếp Theo?
                </h2>
                <p class="text-white/90 text-sm md:text-base mb-5">
                    Liên hệ ngay để được tư vấn và đặt tour với giá ưu đãi!
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-primary-dark font-bold rounded-xl hover:bg-gray-50 hover:shadow-lg transition-all duration-300 text-sm">
                        <i class="fa-solid fa-compass"></i>
                        Tìm Tour Ngay
                    </a>
                    @if ($contactInfo && $contactInfo->phone)
                        <a href="tel:{{ $contactInfo->phone }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl border-2 border-white/30 hover:bg-white/20 transition-all duration-300 text-sm">
                            <i class="fa-solid fa-phone-volume"></i>
                            {{ $contactInfo->phone }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== NEWS SECTION ==================== --}}
    @if (!empty($newsCategories) && $newsCategories->isNotEmpty())
        <div class="bg-white py-10 md:py-14 lg:py-20">
            <div class="container mx-auto px-4 space-y-8 md:space-y-10">
                @foreach ($newsCategories as $categoryIndex => $category)
                    @if ($category->news->isNotEmpty())
                        <section data-aos="fade-up" data-aos-delay="{{ min($categoryIndex * 50, 100) }}">
                            {{-- News Header with Navigation --}}
                            <div class="flex items-end justify-between mb-5 md:mb-6">
                                <div>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-50 text-blue-600 font-semibold rounded-full text-xs mb-2">
                                        <i class="fa-solid fa-newspaper"></i> Tin tức
                                    </span>
                                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800">
                                        {{ $category->name }}
                                    </h2>
                                </div>
                                <div class="flex items-center gap-3">
                                    {{-- Navigation Buttons --}}
                                    <div class="slider-header-nav flex" id="news-nav-{{ $categoryIndex }}">
                                        <button class="slider-nav-btn swiper-button-prev"
                                            aria-label="Tin trước"></button>
                                        <button class="slider-nav-btn swiper-button-next"
                                            aria-label="Tin tiếp theo"></button>
                                    </div>
                                    <a href="{{ route('client.news') }}"
                                        class="hidden md:inline-flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white font-semibold rounded-full transition-all duration-300 text-sm">
                                        Xem tất cả
                                        <i class="fa-solid fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </div>

                            {{-- News Slider --}}
                            <div class="relative slider-overflow-fix">
                                <div class="swiper news-slider" id="news-slider-{{ $categoryIndex }}">
                                    <div class="swiper-wrapper">
                                        @foreach ($category->news as $newsItem)
                                            <div class="swiper-slide">
                                                <x-client.news-card :news="$newsItem" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Mobile View All --}}
                            <div class="mt-5 text-center md:hidden">
                                <a href="{{ route('client.news') }}"
                                    class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm">
                                    Xem tất cả tin tức
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </section>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endsection

@push('styles')
    <style>
        /* ==================== HERO SECTION ==================== */
        .hero-section {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        .gradient-text-hero {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .typed-cursor {
            color: #f59e0b;
            font-weight: 100;
        }

        /* Hero GSAP initial states */
        .hero-badge,
        .hero-title,
        .hero-typing,
        .hero-description,
        .hero-cta,
        .hero-search {
            opacity: 0;
        }

        /* ==================== FLOATING ANIMATIONS ==================== */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-3deg); }
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }

        /* ==================== PARTICLES ==================== */
        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: particle-float 15s infinite;
        }

        .particle-1 { top: 20%; left: 10%; }
        .particle-2 { top: 60%; left: 20%; animation-delay: 2s; width: 15px; height: 15px; }
        .particle-3 { top: 30%; right: 15%; animation-delay: 4s; width: 8px; height: 8px; }
        .particle-4 { top: 70%; right: 25%; animation-delay: 6s; width: 12px; height: 12px; }
        .particle-5 { top: 40%; left: 40%; animation-delay: 8s; width: 6px; height: 6px; }

        @keyframes particle-float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0.3; }
            25% { transform: translateY(-50px) translateX(20px); opacity: 0.6; }
            50% { transform: translateY(-20px) translateX(-10px); opacity: 0.4; }
            75% { transform: translateY(-60px) translateX(15px); opacity: 0.5; }
        }

        /* ==================== COMPONENTS ==================== */
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
        }

        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        /* ==================== TOUCH OPTIMIZATIONS ==================== */
        @media (hover: none) and (pointer: coarse) {
            .feature-card:hover,
            .tour-card:hover,
            .news-card:hover {
                transform: translateY(-2px);
            }
        }

        /* Reduce motion for accessibility */
        @media (prefers-reduced-motion: reduce) {
            .particle,
            .animate-float,
            .animate-float-slow {
                animation: none;
            }
        }
    </style>
@endpush

@push('scripts')
    {{-- Typed.js for typing animation --}}
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ==================== HERO SLIDER ====================
            new Swiper('.hero-slider', {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false
                },
                speed: 1500,
                on: {
                    slideChange: function() {
                        // Ken Burns effect reset
                        const activeSlide = this.slides[this.activeIndex];
                        const bg = activeSlide.querySelector('div');
                        if (bg) {
                            bg.style.transform = 'scale(1)';
                            setTimeout(() => {
                                bg.style.transform = 'scale(1.1)';
                            }, 100);
                        }
                    }
                }
            });

            // ==================== GSAP HERO ANIMATIONS ====================
            if (typeof gsap !== 'undefined') {
                const heroTl = gsap.timeline({
                    delay: 0.5
                });

                heroTl
                    .to('.hero-badge', {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        ease: 'power3.out'
                    })
                    .to('.hero-title', {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        ease: 'power3.out'
                    }, '-=0.3')
                    .to('.hero-typing', {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        ease: 'power3.out'
                    }, '-=0.4')
                    .to('.hero-description', {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        ease: 'power3.out'
                    }, '-=0.3')
                    .to('.hero-cta', {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        ease: 'power3.out'
                    }, '-=0.3')
                    .to('.hero-search', {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        ease: 'power3.out'
                    }, '-=0.2');

                // Set initial states
                gsap.set(['.hero-badge', '.hero-title', '.hero-typing', '.hero-description', '.hero-cta',
                    '.hero-search'
                ], {
                    y: 30
                });
            }

            // ==================== TYPED.JS ====================
            const typedPhrases = @json($heroTypingPhrases);

            if (document.getElementById('typed-text')) {
                new Typed('#typed-text', {
                    strings: typedPhrases,
                    typeSpeed: 60,
                    backSpeed: 40,
                    backDelay: 2000,
                    loop: true,
                    showCursor: true,
                    cursorChar: '|'
                });
            }

            // ==================== STATS COUNTER ====================
            const statObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const statNumbers = entry.target.querySelectorAll('.stat-number');
                        statNumbers.forEach(el => {
                            const target = parseInt(el.dataset.count) || 0;
                            const duration = 2000;
                            const step = target / (duration / 16);
                            let current = 0;

                            const updateCounter = () => {
                                current += step;
                                if (current < target) {
                                    el.textContent = Math.floor(current)
                                        .toLocaleString();
                                    requestAnimationFrame(updateCounter);
                                } else {
                                    el.textContent = target.toLocaleString();
                                }
                            };
                            updateCounter();
                        });
                        statObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.3
            });

            const statsSection = document.getElementById('stats-section');
            if (statsSection) {
                statObserver.observe(statsSection);
            }

            // ==================== SLIDER CONFIGURATION ====================
            const sliderConfig = {
                slidesPerView: 1.2,
                spaceBetween: 12,
                watchOverflow: true,
                grabCursor: true,
                breakpoints: {
                    480: { slidesPerView: 1.5, spaceBetween: 12 },
                    640: { slidesPerView: 2, spaceBetween: 14 },
                    768: { slidesPerView: 2.5, spaceBetween: 16 },
                    1024: { slidesPerView: 3, spaceBetween: 16 },
                    1280: { slidesPerView: 4, spaceBetween: 20 },
                }
            };

            // Featured Tours Slider
            const featuredSlider = document.getElementById('featured-tours-slider');
            const featuredNav = document.getElementById('featured-tours-nav');
            if (featuredSlider) {
                new Swiper(featuredSlider, {
                    ...sliderConfig,
                    navigation: featuredNav ? {
                        nextEl: featuredNav.querySelector('.swiper-button-next'),
                        prevEl: featuredNav.querySelector('.swiper-button-prev')
                    } : false
                });
            }

            // Category Tour Sliders
            document.querySelectorAll('[id^="cat-slider-"]').forEach(slider => {
                const index = slider.id.split('-').pop();
                const nav = document.getElementById(`cat-nav-${index}`);
                new Swiper(slider, {
                    ...sliderConfig,
                    navigation: nav ? {
                        nextEl: nav.querySelector('.swiper-button-next'),
                        prevEl: nav.querySelector('.swiper-button-prev')
                    } : false
                });
            });

            // News Sliders
            document.querySelectorAll('[id^="news-slider-"]').forEach(slider => {
                const index = slider.id.split('-').pop();
                const nav = document.getElementById(`news-nav-${index}`);
                new Swiper(slider, {
                    ...sliderConfig,
                    navigation: nav ? {
                        nextEl: nav.querySelector('.swiper-button-next'),
                        prevEl: nav.querySelector('.swiper-button-prev')
                    } : false
                });
            });

            // Fallback: Initialize any remaining sliders with default config
            document.querySelectorAll('.swiper.tour-slider:not([id]), .swiper.news-slider:not([id])').forEach(slider => {
                if (!slider.swiper) {
                    const container = slider.closest('.slider-container');
                    new Swiper(slider, {
                        ...sliderConfig,
                        navigation: container ? {
                            nextEl: container.querySelector('.swiper-button-next'),
                            prevEl: container.querySelector('.swiper-button-prev')
                        } : false
                    });
                }
            });
        });
    </script>
@endpush
