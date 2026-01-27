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
        <div class="relative z-30 container mx-auto px-4 text-center pt-20 md:pt-24 lg:pt-28">
            <div class="hero-content max-w-4xl mx-auto">
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
            <div class="hero-search max-w-4xl mx-auto relative z-40">
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
    <section class="md:hidden px-4 py-3 bg-gray-50">
        <x-client.tour-search-bar variant="mobile" />
    </section>

    {{-- ==================== WHY CHOOSE US SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-24 bg-white relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div
                class="absolute top-0 left-0 w-48 md:w-72 h-48 md:h-72 bg-primary rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-amber-400 rounded-full blur-3xl translate-x-1/2 translate-y-1/2">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-8 md:mb-12 lg:mb-16" data-aos="fade-up">
                <span
                    class="inline-block px-3 md:px-4 py-1 md:py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-xs md:text-sm mb-3 md:mb-4">
                    Tại sao chọn chúng tôi
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 mb-3 md:mb-4">
                    Đồng Hành Cùng <span class="gradient-text">King Express</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base lg:text-lg px-2">
                    Với nhiều năm kinh nghiệm, chúng tôi tự hào mang đến trải nghiệm du lịch hoàn hảo nhất
                </p>
            </div>

            {{-- Features Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
                @foreach ($features as $index => $feature)
                    <div class="feature-card group relative p-5 md:p-6 lg:p-8 bg-white rounded-2xl md:rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        {{-- Icon --}}
                        <div class="relative mb-4 md:mb-6">
                            <div
                                class="w-12 h-12 md:w-14 md:h-14 lg:w-16 lg:h-16 rounded-xl md:rounded-2xl bg-{{ $feature['color'] }}-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="{{ $feature['icon'] }} text-xl md:text-2xl text-{{ $feature['color'] }}-500"></i>
                            </div>
                            <div
                                class="absolute -inset-2 bg-{{ $feature['color'] }}-200 rounded-2xl opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300">
                            </div>
                        </div>
                        {{-- Content --}}
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600 text-sm md:text-base">{{ $feature['description'] }}</p>
                        {{-- Hover effect --}}
                        <div
                            class="absolute top-0 right-0 w-24 md:w-32 h-24 md:h-32 bg-gradient-to-br from-{{ $feature['color'] }}-100 to-transparent rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== STATISTICS SECTION ==================== --}}
    <section
        class="py-12 md:py-16 lg:py-20 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        {{-- Animated background --}}
        <div class="absolute inset-0">
            <div
                class="absolute top-0 left-1/4 w-64 md:w-96 h-64 md:h-96 bg-primary/20 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div class="absolute bottom-0 right-1/4 w-48 md:w-72 h-48 md:h-72 bg-amber-500/20 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8 xl:gap-12">
                {{-- Total Tours --}}
                <div class="stat-item text-center" data-aos="zoom-in" data-aos-delay="0">
                    <div class="relative inline-block mb-3 md:mb-4">
                        <div
                            class="w-14 h-14 md:w-16 md:h-16 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center">
                            <i class="fa-solid fa-route text-xl md:text-2xl lg:text-3xl text-white"></i>
                        </div>
                        <div class="absolute inset-0 rounded-full bg-primary/50 blur-xl animate-pulse"></div>
                    </div>
                    <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-1 md:mb-2">
                        <span class="stat-number" data-count="{{ $statistics['total_tours'] ?? 50 }}">0</span>+
                    </div>
                    <p class="text-gray-400 font-medium text-xs md:text-sm lg:text-base">Tour du lịch</p>
                </div>

                {{-- Destinations --}}
                <div class="stat-item text-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="relative inline-block mb-3 md:mb-4">
                        <div
                            class="w-14 h-14 md:w-16 md:h-16 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center">
                            <i class="fa-solid fa-location-dot text-xl md:text-2xl lg:text-3xl text-white"></i>
                        </div>
                        <div class="absolute inset-0 rounded-full bg-blue-500/50 blur-xl animate-pulse"
                            style="animation-delay: 0.5s;"></div>
                    </div>
                    <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-1 md:mb-2">
                        <span class="stat-number" data-count="{{ $statistics['total_destinations'] ?? 30 }}">0</span>+
                    </div>
                    <p class="text-gray-400 font-medium text-xs md:text-sm lg:text-base">Điểm đến</p>
                </div>

                {{-- Customers --}}
                <div class="stat-item text-center" data-aos="zoom-in" data-aos-delay="200">
                    <div class="relative inline-block mb-3 md:mb-4">
                        <div
                            class="w-14 h-14 md:w-16 md:h-16 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-green-500 to-emerald-400 flex items-center justify-center">
                            <i class="fa-solid fa-users text-xl md:text-2xl lg:text-3xl text-white"></i>
                        </div>
                        <div class="absolute inset-0 rounded-full bg-green-500/50 blur-xl animate-pulse"
                            style="animation-delay: 1s;"></div>
                    </div>
                    <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-1 md:mb-2">
                        <span class="stat-number"
                            data-count="{{ ($statistics['total_customers'] ?? 0) + 1000 }}">0</span>+
                    </div>
                    <p class="text-gray-400 font-medium text-xs md:text-sm lg:text-base">Khách hàng</p>
                </div>

                {{-- Years Experience --}}
                <div class="stat-item text-center" data-aos="zoom-in" data-aos-delay="300">
                    <div class="relative inline-block mb-3 md:mb-4">
                        <div
                            class="w-14 h-14 md:w-16 md:h-16 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-purple-500 to-pink-400 flex items-center justify-center">
                            <i class="fa-solid fa-award text-xl md:text-2xl lg:text-3xl text-white"></i>
                        </div>
                        <div class="absolute inset-0 rounded-full bg-purple-500/50 blur-xl animate-pulse"
                            style="animation-delay: 1.5s;"></div>
                    </div>
                    <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-1 md:mb-2">
                        <span class="stat-number" data-count="{{ $statistics['years_experience'] ?? 10 }}">0</span>+
                    </div>
                    <p class="text-gray-400 font-medium text-xs md:text-sm lg:text-base">Năm kinh nghiệm</p>
                </div>
            </div>
        </div>

        {{-- Wave Separator --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path
                    d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                    fill="#f9fafb" />
            </svg>
        </div>
    </section>

    {{-- ==================== POPULAR DESTINATIONS SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-8 md:mb-12" data-aos="fade-up">
                <span
                    class="inline-block px-3 md:px-4 py-1 md:py-1.5 bg-blue-100 text-blue-600 font-semibold rounded-full text-xs md:text-sm mb-3 md:mb-4">
                    <i class="fa-solid fa-fire mr-1"></i> Điểm đến phổ biến
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 mb-3 md:mb-4">
                    Khám Phá <span class="gradient-text">Điểm Đến</span> Yêu Thích
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base lg:text-lg">
                    Những điểm đến được du khách yêu thích nhất
                </p>
            </div>

            {{-- Destinations Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 lg:gap-6">
                @foreach ($staticDestinations as $index => $destination)
                    <a href="{{ route('client.tours', ['destination' => $destination['slug']]) }}"
                        class="destination-card group relative aspect-[4/3] rounded-xl md:rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : '' }}"
                        data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        {{-- Background Image with fallback --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-700 to-gray-900">
                            <img src="{{ asset($destination['thumbnail']) }}" alt="{{ $destination['name'] }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                loading="lazy">
                        </div>
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        {{-- Content --}}
                        <div class="absolute bottom-0 left-0 right-0 p-3 md:p-4 lg:p-6">
                            <h3
                                class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-white mb-1 group-hover:text-primary transition-colors">
                                {{ $destination['name'] }}
                            </h3>
                            <p class="text-white/80 text-xs md:text-sm flex items-center gap-1 md:gap-2">
                                <i class="fa-solid fa-map-marker-alt text-primary"></i>
                                {{ $destination['tours_count'] }} tour
                            </p>
                            {{-- Price reveal on hover --}}
                            <p
                                class="text-white/70 text-xs mt-1 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                Từ <span
                                    class="text-primary font-bold">{{ number_format($destination['min_price'] ?? 1990000) }}đ</span>
                            </p>
                        </div>
                        {{-- Hover Arrow --}}
                        <div
                            class="absolute top-3 md:top-4 right-3 md:right-4 w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-300">
                            <i class="fa-solid fa-arrow-right text-white text-sm md:text-base"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== FEATURED TOURS SECTION ==================== --}}
    @if (!empty($featuredTours) && $featuredTours->count() > 0)
        <section class="py-12 md:py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4">
                {{-- Section Header --}}
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 md:mb-8 lg:mb-10"
                    data-aos="fade-up">
                    <div>
                        <span
                            class="inline-block px-3 md:px-4 py-1 md:py-1.5 bg-gradient-to-r from-primary/20 to-amber-200 text-primary-dark font-semibold rounded-full text-xs md:text-sm mb-3 md:mb-4">
                            <i class="fa-solid fa-crown mr-1"></i> Tour nổi bật
                        </span>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-gray-900">
                            Tour <span class="gradient-text">Hot</span> Nhất
                        </h2>
                    </div>
                    <a href="{{ route('client.tours') }}"
                        class="mt-3 md:mt-0 inline-flex items-center gap-2 text-primary hover:text-primary-dark font-semibold transition-colors text-sm md:text-base">
                        Xem tất cả
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                {{-- Tours Slider --}}
                <div class="relative slider-container" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper featured-tours-slider">
                        <div class="swiper-wrapper">
                            @foreach ($featuredTours as $tour)
                                <div class="swiper-slide h-auto">
                                    <x-client.tour-card :tour="$tour" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="slider-nav-btn swiper-button-prev"></div>
                    <div class="slider-nav-btn swiper-button-next"></div>
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== TOUR CATEGORIES SECTIONS ==================== --}}
    <div class="bg-gray-100 py-12 md:py-16 lg:py-24">
        <div class="container mx-auto px-4 space-y-10 md:space-y-12 lg:space-y-16">
            @if (!empty($tourCategories) && $tourCategories->isNotEmpty())
                @foreach ($tourCategories as $categoryIndex => $category)
                    @if ($category->tours->isNotEmpty())
                        <section data-aos="fade-up" data-aos-delay="{{ $categoryIndex * 100 }}">
                            <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 md:mb-8">
                                <div>
                                    <h2
                                        class="text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-800 uppercase flex items-center gap-2 md:gap-3">
                                        <span
                                            class="w-1 md:w-1.5 h-6 md:h-8 bg-gradient-to-b from-primary to-amber-400 rounded-full"></span>
                                        {{ $category->name }}
                                    </h2>
                                    <div
                                        class="mt-2 w-16 md:w-24 h-1 bg-gradient-to-r from-primary to-transparent rounded-full">
                                    </div>
                                </div>
                            </div>
                            <div class="relative slider-container">
                                <div class="swiper tour-slider">
                                    <div class="swiper-wrapper">
                                        @foreach ($category->tours as $tour)
                                            <div class="swiper-slide h-auto">
                                                <x-client.tour-card :tour="$tour" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="slider-nav-btn swiper-button-prev"></div>
                                <div class="slider-nav-btn swiper-button-next"></div>
                            </div>
                        </section>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    {{-- ==================== ABOUT US BRIEF SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8 md:gap-10 lg:gap-12 xl:gap-16 items-center">
                {{-- Image Side --}}
                <div class="relative" data-aos="fade-right">
                    <div class="relative z-10">
                        <img src="{{ asset('client/images/cities/ninhbinh/trangan.jpg') }}" alt="King Express Travel"
                            class="rounded-2xl md:rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]">
                    </div>
                    {{-- Decorative Elements --}}
                    <div
                        class="absolute -bottom-4 md:-bottom-6 -right-4 md:-right-6 w-48 md:w-72 h-48 md:h-72 bg-gradient-to-br from-primary/30 to-amber-200/30 rounded-2xl md:rounded-3xl -z-10">
                    </div>
                    <div
                        class="absolute -top-4 md:-top-6 -left-4 md:-left-6 w-20 md:w-32 h-20 md:h-32 bg-gradient-to-br from-blue-400/30 to-cyan-200/30 rounded-xl md:rounded-2xl -z-10">
                    </div>
                    {{-- Stats Badge --}}
                    <div class="absolute -bottom-2 md:-bottom-4 left-4 md:left-8 bg-white rounded-xl md:rounded-2xl shadow-xl p-4 md:p-6 z-20"
                        data-aos="zoom-in" data-aos-delay="300">
                        <div class="flex items-center gap-3 md:gap-4">
                            <div
                                class="w-10 h-10 md:w-14 md:h-14 rounded-lg md:rounded-xl bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center">
                                <i class="fa-solid fa-trophy text-lg md:text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-xl md:text-2xl font-black text-gray-900">
                                    {{ $statistics['years_experience'] ?? 10 }}+
                                </p>
                                <p class="text-gray-600 text-xs md:text-sm">Năm kinh nghiệm</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Side --}}
                <div data-aos="fade-left">
                    <span
                        class="inline-block px-3 md:px-4 py-1 md:py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-xs md:text-sm mb-3 md:mb-4">
                        Về chúng tôi
                    </span>
                    <h2
                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 mb-4 md:mb-6 leading-tight">
                        Hành Trình Của Bạn,<br>
                        <span class="gradient-text">Đam Mê Của Chúng Tôi</span>
                    </h2>
                    <p class="text-gray-600 text-sm md:text-base lg:text-lg mb-4 md:mb-6 leading-relaxed">
                        King Express Travel tự hào là đơn vị lữ hành uy tín với nhiều năm kinh nghiệm trong ngành du lịch.
                        Chúng tôi cam kết mang đến những trải nghiệm du lịch tuyệt vời nhất với dịch vụ chất lượng cao và
                        giá cả phải chăng.
                    </p>
                    <ul class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                        <li class="flex items-center gap-2 md:gap-3">
                            <span
                                class="w-5 h-5 md:w-6 md:h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-green-600 text-xs"></i>
                            </span>
                            <span class="text-gray-700 text-sm md:text-base">Đội ngũ hướng dẫn viên chuyên nghiệp, tận
                                tâm</span>
                        </li>
                        <li class="flex items-center gap-2 md:gap-3">
                            <span
                                class="w-5 h-5 md:w-6 md:h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-green-600 text-xs"></i>
                            </span>
                            <span class="text-gray-700 text-sm md:text-base">Lịch trình được thiết kế tối ưu, linh
                                hoạt</span>
                        </li>
                        <li class="flex items-center gap-2 md:gap-3">
                            <span
                                class="w-5 h-5 md:w-6 md:h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-green-600 text-xs"></i>
                            </span>
                            <span class="text-gray-700 text-sm md:text-base">Dịch vụ khách sạn, vận chuyển chất lượng
                                cao</span>
                        </li>
                    </ul>
                    <a href="{{ route('client.about') }}"
                        class="inline-flex items-center gap-2 px-5 md:px-6 py-2.5 md:py-3 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-lg md:rounded-xl hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 text-sm md:text-base">
                        Tìm hiểu thêm
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== TESTIMONIALS SECTION ==================== --}}
    <section
        class="py-12 md:py-16 lg:py-24 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 80 80%22><path d=%22M0 0h80v80H0z%22 fill=%22none%22/><path d=%22M0 80V0l20 20L0 40l20 20zm40 0V0l20 20-20 20 20 20zM20 40l20-20v40z%22 fill=%22%23fff%22 fill-opacity=%22.03%22/></svg>');">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-8 md:mb-12" data-aos="fade-up">
                <span
                    class="inline-block px-3 md:px-4 py-1 md:py-1.5 bg-white/10 text-white font-semibold rounded-full text-xs md:text-sm mb-3 md:mb-4 backdrop-blur-sm">
                    <i class="fa-solid fa-star text-yellow-400 mr-1"></i> Đánh giá từ khách hàng
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-3 md:mb-4">
                    Khách Hàng <span class="text-primary">Nói Gì</span> Về Chúng Tôi
                </h2>
            </div>

            {{-- Testimonials Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
                @foreach ($testimonials as $index => $testimonial)
                    <div class="testimonial-card bg-white/5 backdrop-blur-sm rounded-xl md:rounded-2xl p-5 md:p-6 lg:p-8 border border-white/10 hover:bg-white/10 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        {{-- Quote Icon --}}
                        <div class="text-primary/30 text-3xl md:text-4xl lg:text-5xl mb-3 md:mb-4">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        {{-- Rating --}}
                        <div class="flex gap-0.5 md:gap-1 mb-3 md:mb-4">
                            @for ($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)
                                <i class="fa-solid fa-star text-yellow-400 text-sm md:text-base"></i>
                            @endfor
                        </div>
                        {{-- Comment --}}
                        <p class="text-white/80 mb-4 md:mb-6 leading-relaxed text-sm md:text-base">
                            "{{ $testimonial['comment'] }}"
                        </p>
                        {{-- Author --}}
                        <div class="flex items-center gap-3 md:gap-4">
                            <div
                                class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center text-white font-bold text-sm md:text-base">
                                {{ mb_substr($testimonial['name'], 0, 1) }}
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm md:text-base flex items-center gap-1.5">
                                    {{ $testimonial['name'] }}
                                    @if ($testimonial['verified'] ?? false)
                                        <i class="fa-solid fa-circle-check text-blue-400 text-xs"
                                            title="Khách hàng đã xác minh"></i>
                                    @endif
                                </p>
                                <p class="text-white/60 text-xs md:text-sm">{{ $testimonial['tour'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CTA SECTION ==================== --}}
    <section
        class="py-12 md:py-16 lg:py-20 bg-gradient-to-r from-primary via-amber-500 to-primary-dark relative overflow-hidden">
        {{-- Animated Background --}}
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full opacity-20"
                style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 50px 50px;">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center" data-aos="zoom-in">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4 md:mb-6">
                    Sẵn Sàng Cho Chuyến Đi Tiếp Theo?
                </h2>
                <p class="text-white/90 text-sm md:text-base lg:text-lg xl:text-xl mb-6 md:mb-8 px-2">
                    Liên hệ ngay với chúng tôi để được tư vấn và đặt tour với giá ưu đãi nhất!
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 md:px-8 py-3 md:py-4 bg-white text-primary-dark font-bold rounded-xl md:rounded-2xl hover:bg-gray-100 transition-all duration-300 shadow-xl text-sm md:text-base">
                        <i class="fa-solid fa-search"></i>
                        Tìm Tour Ngay
                    </a>
                    @if ($contactInfo && $contactInfo->phone)
                        <a href="tel:{{ $contactInfo->phone }}"
                            class="inline-flex items-center justify-center gap-2 px-6 md:px-8 py-3 md:py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl md:rounded-2xl border-2 border-white/30 hover:bg-white/20 transition-all duration-300 text-sm md:text-base">
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
        <div class="bg-gray-50 py-12 md:py-16 lg:py-24">
            <div class="container mx-auto px-4 space-y-8 md:space-y-10 lg:space-y-12">
                @foreach ($newsCategories as $categoryIndex => $category)
                    @if ($category->news->isNotEmpty())
                        <section data-aos="fade-up" data-aos-delay="{{ $categoryIndex * 100 }}">
                            <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 md:mb-8">
                                <div>
                                    <span
                                        class="inline-block px-2.5 md:px-3 py-0.5 md:py-1 bg-blue-100 text-blue-600 font-semibold rounded-full text-xs md:text-sm mb-2">
                                        <i class="fa-solid fa-newspaper mr-1"></i> Tin tức
                                    </span>
                                    <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-800">
                                        {{ $category->name }}
                                    </h2>
                                </div>
                                <a href="{{ route('client.news') }}"
                                    class="mt-3 md:mt-0 inline-flex items-center gap-2 text-primary hover:text-primary-dark font-semibold transition-colors text-sm md:text-base">
                                    Xem tất cả
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="relative slider-container">
                                <div class="swiper news-slider">
                                    <div class="swiper-wrapper">
                                        @foreach ($category->news as $newsItem)
                                            <div class="swiper-slide h-auto">
                                                <x-client.news-card :news="$newsItem" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="slider-nav-btn swiper-button-prev"></div>
                                <div class="slider-nav-btn swiper-button-next"></div>
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
        /* ==================== HERO SECTION STYLES ==================== */
        .hero-section {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        .gradient-text-hero {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Typed.js cursor */
        .typed-cursor {
            color: #f59e0b;
            font-weight: 100;
        }

        /* Floating animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(-3deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        /* Particles */
        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: particle-float 15s infinite;
        }

        .particle-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle-2 {
            top: 60%;
            left: 20%;
            animation-delay: 2s;
            width: 15px;
            height: 15px;
        }

        .particle-3 {
            top: 30%;
            right: 15%;
            animation-delay: 4s;
            width: 8px;
            height: 8px;
        }

        .particle-4 {
            top: 70%;
            right: 25%;
            animation-delay: 6s;
            width: 12px;
            height: 12px;
        }

        .particle-5 {
            top: 40%;
            left: 40%;
            animation-delay: 8s;
            width: 6px;
            height: 6px;
        }

        @keyframes particle-float {

            0%,
            100% {
                transform: translateY(0) translateX(0);
                opacity: 0.3;
            }

            25% {
                transform: translateY(-50px) translateX(20px);
                opacity: 0.6;
            }

            50% {
                transform: translateY(-20px) translateX(-10px);
                opacity: 0.4;
            }

            75% {
                transform: translateY(-60px) translateX(15px);
                opacity: 0.5;
            }
        }

        /* Scroll indicator */
        .scroll-indicator {
            animation: fadeIn 1s ease-out 2s backwards;
        }

        /* Hero entrance animations - handled by GSAP */
        .hero-badge,
        .hero-title,
        .hero-typing,
        .hero-description,
        .hero-cta,
        .hero-search {
            opacity: 0;
        }

        /* ==================== GRADIENT TEXT ==================== */
        .gradient-text {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ==================== FEATURE CARDS ==================== */
        .feature-card {
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .feature-card:hover {
            transform: translateY(-8px);
        }

        /* ==================== DESTINATION CARDS ==================== */
        .destination-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .destination-card:hover::before {
            transform: translateX(100%);
        }

        /* ==================== STATS COUNTER ==================== */
        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        /* ==================== MOBILE RESPONSIVE ==================== */
        @media (max-width: 640px) {
            .hero-section {
                min-height: 85vh;
            }

            .feature-card:hover {
                transform: translateY(-4px);
            }
        }

        /* ==================== TOUCH DEVICE OPTIMIZATIONS ==================== */
        @media (max-width: 768px) {

            .destination-card,
            .feature-card,
            .testimonial-card {
                min-height: 48px;
                /* Touch target minimum */
            }
        }

        /* Disable hover effects on touch devices for better performance */
        @media (hover: none) and (pointer: coarse) {
            .tour-card:hover {
                transform: none;
            }

            .feature-card:hover {
                transform: none;
            }

            .destination-card:hover img {
                transform: none;
            }

            .group:hover .tour-card-cta {
                opacity: 1;
                transform: translateY(0);
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

            const statsSection = document.querySelector('.stat-item')?.closest('section');
            if (statsSection) {
                statObserver.observe(statsSection);
            }

            // ==================== TOUR SLIDERS ====================
            document.querySelectorAll('.slider-container').forEach(container => {
                const slider = container.querySelector('.swiper');
                if (slider) {
                    new Swiper(slider, {
                        slidesPerView: 1.15,
                        spaceBetween: 12,
                        navigation: {
                            nextEl: container.querySelector('.swiper-button-next'),
                            prevEl: container.querySelector('.swiper-button-prev')
                        },
                        watchOverflow: true,
                        breakpoints: {
                            480: {
                                slidesPerView: 1.5,
                                spaceBetween: 12
                            },
                            640: {
                                slidesPerView: 2,
                                spaceBetween: 16
                            },
                            768: {
                                slidesPerView: 2.5,
                                spaceBetween: 16
                            },
                            1024: {
                                slidesPerView: 3.5,
                                spaceBetween: 16
                            },
                            1280: {
                                slidesPerView: 4,
                                spaceBetween: 20
                            },
                        }
                    });
                }
            });
        });
    </script>
@endpush
