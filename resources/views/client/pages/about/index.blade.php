@extends('client.layouts.app')

@section('title', 'Giới thiệu về King Express Travel - Đồng hành cùng mọi hành trình')
@section('description', 'Tìm hiểu về King Express Travel - Công ty du lịch nội địa hàng đầu với hơn 10 năm kinh nghiệm. Hotline: 0858446699')

@php
    // ==================== STATIC DATA ====================
    $companyInfo = [
        'name' => 'Công ty Du lịch King Express',
        'short_name' => 'King Express Travel',
        'slogan' => 'Đồng hành cùng mọi hành trình của bạn',
        'description' => 'King Express Travel là đơn vị lữ hành chuyên nghiệp hàng đầu Việt Nam, chuyên cung cấp các tour du lịch nội địa chất lượng cao. Với hơn 10 năm kinh nghiệm trong ngành, chúng tôi tự hào đã đồng hành cùng hàng nghìn khách hàng trên khắp mọi miền đất nước.',
        'phone' => '0858446699',
        'email' => 'kingexpressbus@gmail.com',
        'hotline' => '0858446699',
        'zalo' => '0858446699',
        'working_hours' => 'Thứ 2 - Thứ 7: 8:00 - 17:30',
        'facebook' => 'https://facebook.com/kingexpresstravel',
        'youtube' => 'https://youtube.com/@kingexpresstravel',
        'founded_year' => 2014,
    ];

    $office = [
        'name' => 'Trụ sở chính Hà Nội',
        'address' => '19 Hàng Thiếc, Phường Hoàn Kiếm, Thành Phố Hà Nội',
        'phone' => '0858446699',
        'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.096947669847!2d105.84772731533215!3d21.03084898599492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abbfd46c57af%3A0xe0a0e6b9e12d5a62!2zMTkgSMOgbmcgVGhp4bq_YywgSMOgbmcgR2FpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1703149200000!5m2!1svi!2s',
    ];

    $heroTypingPhrases = [
        'Du lịch là đam mê',
        'Trải nghiệm là cuộc sống',
        'Khám phá vẻ đẹp Việt Nam',
        'Tạo nên những kỷ niệm đẹp',
        'Đồng hành cùng bạn mọi nơi',
    ];

    $stats = [
        ['icon' => 'fa-solid fa-route', 'value' => 50, 'suffix' => '+', 'label' => 'Tour du lịch', 'color' => 'from-primary to-amber-400'],
        ['icon' => 'fa-solid fa-location-dot', 'value' => 30, 'suffix' => '+', 'label' => 'Điểm đến', 'color' => 'from-blue-500 to-cyan-400'],
        ['icon' => 'fa-solid fa-users', 'value' => 10000, 'suffix' => '+', 'label' => 'Khách hàng', 'color' => 'from-green-500 to-emerald-400'],
        ['icon' => 'fa-solid fa-award', 'value' => 10, 'suffix' => '+', 'label' => 'Năm kinh nghiệm', 'color' => 'from-purple-500 to-pink-400'],
    ];

    $vision = 'Trở thành công ty du lịch nội địa hàng đầu Việt Nam, mang đến những trải nghiệm du lịch đẳng cấp và chất lượng nhất cho mọi khách hàng.';
    $mission = 'Chúng tôi cam kết cung cấp dịch vụ du lịch chuyên nghiệp, an toàn và chu đáo. Mỗi chuyến đi là một hành trình khám phá, một trải nghiệm đáng nhớ.';

    $coreValues = [
        ['icon' => 'fa-solid fa-heart', 'title' => 'Tận tâm', 'desc' => 'Luôn đặt khách hàng làm trung tâm, phục vụ bằng cả tấm lòng'],
        ['icon' => 'fa-solid fa-handshake', 'title' => 'Uy tín', 'desc' => 'Cam kết thực hiện đúng những gì đã hứa với khách hàng'],
        ['icon' => 'fa-solid fa-gem', 'title' => 'Chất lượng', 'desc' => 'Không ngừng nâng cao chất lượng dịch vụ và trải nghiệm'],
        ['icon' => 'fa-solid fa-lightbulb', 'title' => 'Sáng tạo', 'desc' => 'Liên tục đổi mới, mang đến những sản phẩm du lịch độc đáo'],
    ];

    $timeline = [
        ['year' => '2014', 'title' => 'Khởi đầu', 'desc' => 'King Express Travel được thành lập tại Hà Nội với đội ngũ 5 nhân viên'],
        ['year' => '2016', 'title' => 'Phát triển', 'desc' => 'Mở rộng mạng lưới tour du lịch ra khắp miền Bắc'],
        ['year' => '2018', 'title' => 'Bứt phá', 'desc' => 'Đạt mốc 5000 khách hàng, mở rộng tour toàn quốc'],
        ['year' => '2020', 'title' => 'Chuyển đổi số', 'desc' => 'Ra mắt website đặt tour trực tuyến, ứng dụng di động'],
        ['year' => '2024', 'title' => 'Vươn xa', 'desc' => 'Hơn 10.000 khách hàng tin tưởng, 50+ tour đa dạng'],
    ];

    $whyChooseUs = [
        ['icon' => 'fa-solid fa-medal', 'title' => 'Kinh nghiệm 10+ năm', 'desc' => 'Hơn một thập kỷ đồng hành cùng hàng nghìn khách hàng trên khắp Việt Nam'],
        ['icon' => 'fa-solid fa-headset', 'title' => 'Hỗ trợ 24/7', 'desc' => 'Đội ngũ tư vấn viên nhiệt tình, sẵn sàng hỗ trợ bạn mọi lúc mọi nơi'],
        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'An toàn tuyệt đối', 'desc' => 'Cam kết bảo hiểm du lịch, phương tiện chất lượng, đảm bảo an toàn'],
        ['icon' => 'fa-solid fa-coins', 'title' => 'Giá cả hợp lý', 'desc' => 'Chính sách giá minh bạch, cạnh tranh, nhiều ưu đãi hấp dẫn'],
        ['icon' => 'fa-solid fa-star', 'title' => 'Dịch vụ 5 sao', 'desc' => 'Đối tác khách sạn, nhà hàng, điểm tham quan uy tín hàng đầu'],
        ['icon' => 'fa-solid fa-book-open', 'title' => 'Tour đa dạng', 'desc' => 'Từ tour nghỉ dưỡng, văn hóa đến mạo hiểm - đáp ứng mọi nhu cầu'],
    ];

    $galleryImages = [
        ['alt' => 'Du lịch Hà Nội - Thành phố vì hòa bình', 'src' => 'client/images/cities/hanoi/tp.jpg'],
        ['alt' => 'Khám phá TP.HCM - Hòn ngọc Viễn Đông', 'src' => 'client/images/cities/hochiminh/tphcm.jpg'],
        ['alt' => 'Vịnh Hạ Long - Di sản thế giới', 'src' => 'client/images/cities/quangninh/halongbay.webp'],
        ['alt' => 'Cố đô Huế - Vẻ đẹp trầm mặc', 'src' => 'client/images/cities/hue/kinhthanh.jpg'],
        ['alt' => 'Tràng An Ninh Bình - Non nước hữu tình', 'src' => 'client/images/cities/ninhbinh/trangan.jpg'],
        ['alt' => 'Biển Sầm Sơn - Thanh Hóa', 'src' => 'client/images/cities/thanhhoa/th bien.jpg'],
    ];

    $teamMembers = [
        ['name' => 'Nguyễn Quốc Anh', 'role' => 'Giám đốc điều hành', 'avatar' => null, 'color' => 'from-primary to-amber-500'],
        ['name' => 'Trần Thị Mai', 'role' => 'Trưởng phòng Tour', 'avatar' => null, 'color' => 'from-pink-500 to-rose-500'],
        ['name' => 'Phạm Minh Tuấn', 'role' => 'Trưởng phòng Marketing', 'avatar' => null, 'color' => 'from-blue-500 to-cyan-500'],
        ['name' => 'Hoàng Thu Hà', 'role' => 'Tư vấn viên cao cấp', 'avatar' => null, 'color' => 'from-green-500 to-emerald-500'],
    ];

    $testimonials = [
        [
            'name' => 'Chị Ngọc Linh',
            'location' => 'Hà Nội',
            'avatar' => null,
            'rating' => 5,
            'content' => 'Gia đình tôi đã đi tour Đà Lạt cùng King Express. Dịch vụ tuyệt vời, hướng dẫn viên nhiệt tình, khách sạn sạch sẽ. Chắc chắn sẽ quay lại!',
        ],
        [
            'name' => 'Anh Minh Đức',
            'location' => 'TP.HCM',
            'avatar' => null,
            'rating' => 5,
            'content' => 'Tour Hạ Long 3 ngày 2 đêm rất đáng giá. Xe đưa đón thoải mái, ăn uống ngon, cảnh đẹp. 10 điểm!',
        ],
        [
            'name' => 'Chị Thu Trang',
            'location' => 'Đà Nẵng',
            'avatar' => null,
            'rating' => 5,
            'content' => 'Lần đầu đi tour một mình, được King Express hỗ trợ rất nhiệt tình từ khâu tư vấn đến suốt chuyến đi. Cảm ơn team!',
        ],
        [
            'name' => 'Anh Quốc Hùng',
            'location' => 'Hải Phòng',
            'avatar' => null,
            'rating' => 5,
            'content' => 'Đặt tour cho công ty 30 người đi Sapa, mọi thứ được sắp xếp chu đáo. Giá cả hợp lý, dịch vụ chuyên nghiệp.',
        ],
    ];
@endphp

@section('content')
    {{-- ==================== HERO SECTION ==================== --}}
    <section class="about-hero relative min-h-[50vh] md:min-h-[60vh] flex items-center justify-center overflow-hidden">
        {{-- Background with gradient and pattern --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-primary-dark to-gray-800"></div>
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%222%22 fill=%22white%22/></svg>'); background-size: 60px 60px;">
            </div>
            {{-- Animated gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-r from-primary/30 via-transparent to-amber-500/30 animate-gradient"
                style="background-size: 200% 200%;"></div>
        </div>

        {{-- Floating Elements --}}
        <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
            <div class="absolute top-20 left-[10%] text-white/10 text-5xl md:text-7xl animate-float">
                <i class="fa-solid fa-plane"></i>
            </div>
            <div class="absolute top-1/4 right-[15%] text-white/10 text-6xl md:text-8xl animate-float-slow">
                <i class="fa-solid fa-mountain-sun"></i>
            </div>
            <div class="absolute bottom-1/4 left-[20%] text-white/5 text-4xl md:text-6xl animate-float"
                style="animation-delay: 1s;">
                <i class="fa-solid fa-compass"></i>
            </div>
            <div class="absolute bottom-1/3 right-[10%] text-white/5 text-5xl md:text-7xl animate-float-slow"
                style="animation-delay: 2s;">
                <i class="fa-solid fa-map"></i>
            </div>
            <div class="absolute top-1/2 left-[5%] text-white/5 text-3xl md:text-5xl animate-float"
                style="animation-delay: 0.5s;">
                <i class="fa-solid fa-camera-retro"></i>
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 text-center py-16 md:py-20 lg:py-24">
            <div class="max-w-4xl mx-auto">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-4 md:mb-6"
                    data-aos="fade-down">
                    <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium">✨ Từ năm {{ $companyInfo['founded_year'] }}</span>
                </div>

                {{-- Main Title --}}
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white mb-3 md:mb-4"
                    data-aos="fade-up" data-aos-delay="100">
                    Về <span class="gradient-text-hero">King Express</span> Travel
                </h1>

                {{-- Typing Text --}}
                <div class="text-lg sm:text-xl md:text-2xl lg:text-3xl text-white/90 font-medium mb-4 md:mb-6 h-10 md:h-12"
                    data-aos="fade-up" data-aos-delay="200">
                    <span id="about-typed-text"></span>
                </div>

                {{-- Description --}}
                <p class="text-white/70 text-sm md:text-base lg:text-lg max-w-2xl mx-auto mb-6 md:mb-8" data-aos="fade-up"
                    data-aos-delay="300">
                    {{ $companyInfo['slogan'] }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center" data-aos="fade-up"
                    data-aos-delay="400">
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary to-amber-500 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 transform hover:scale-105">
                        <i class="fa-solid fa-compass"></i>
                        Khám phá Tour
                    </a>
                    <a href="{{ route('client.contact') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 backdrop-blur-md text-white font-bold rounded-xl border-2 border-white/30 hover:bg-white hover:text-gray-900 transition-all duration-300">
                        <i class="fa-solid fa-phone"></i>
                        Liên hệ ngay
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== INTRODUCTION SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-24 bg-white relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute top-0 right-0 w-72 h-72 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-amber-200/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                {{-- Content Side --}}
                <div data-aos="fade-right">
                    <span
                        class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-sm mb-4">
                        <i class="fa-solid fa-building mr-1"></i> Giới thiệu
                    </span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-6 leading-tight">
                        {{ $companyInfo['name'] }}
                    </h2>
                    <p class="text-gray-600 text-base md:text-lg mb-6 leading-relaxed">
                        {{ $companyInfo['description'] }}
                    </p>

                    {{-- Vision & Mission --}}
                    <div class="space-y-4 mb-8">
                        <div
                            class="p-4 bg-gradient-to-r from-primary/5 to-transparent rounded-xl border-l-4 border-primary">
                            <h4 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-eye text-primary"></i> Tầm nhìn
                            </h4>
                            <p class="text-gray-600 text-sm">{{ $vision }}</p>
                        </div>
                        <div
                            class="p-4 bg-gradient-to-r from-amber-50 to-transparent rounded-xl border-l-4 border-amber-500">
                            <h4 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-bullseye text-amber-500"></i> Sứ mệnh
                            </h4>
                            <p class="text-gray-600 text-sm">{{ $mission }}</p>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600 font-medium">Theo dõi:</span>
                        <a href="{{ $companyInfo['facebook'] }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="{{ $companyInfo['youtube'] }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://zalo.me/{{ $companyInfo['zalo'] }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg">
                            <i class="fa-solid fa-comment-dots"></i>
                        </a>
                    </div>
                </div>

                {{-- Stats Side --}}
                <div class="grid grid-cols-2 gap-4 md:gap-6" data-aos="fade-left">
                    @foreach($stats as $index => $stat)
                        <div class="stat-card group relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-center overflow-hidden"
                            data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                            <div
                                class="absolute inset-0 bg-gradient-to-br {{ $stat['color'] }} opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                            </div>
                            <div class="relative z-10">
                                <div
                                    class="w-14 h-14 rounded-full bg-gradient-to-br {{ $stat['color'] }} flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                    <i class="{{ $stat['icon'] }} text-xl text-white"></i>
                                </div>
                                <div class="text-3xl md:text-4xl font-black text-gray-900 mb-1">
                                    <span class="stat-counter" data-count="{{ $stat['value'] }}">0</span>{{ $stat['suffix'] }}
                                </div>
                                <p class="text-gray-500 font-medium text-sm">{{ $stat['label'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CORE VALUES SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-10 md:mb-14" data-aos="fade-up">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-sm mb-4">
                    <i class="fa-solid fa-heart mr-1"></i> Giá trị cốt lõi
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Điều Làm Nên <span class="gradient-text">King Express</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    Những giá trị cốt lõi định hình văn hóa và cách phục vụ của chúng tôi
                </p>
            </div>

            {{-- Core Values Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($coreValues as $index => $value)
                    <div class="value-card group relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 text-center overflow-hidden"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-primary/0 to-primary/5 group-hover:from-primary/5 group-hover:to-primary/10 transition-all duration-500">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-primary/30">
                                <i class="{{ $value['icon'] }} text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $value['title'] }}</h3>
                            <p class="text-gray-500 text-sm">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ==================== HISTORY TIMELINE SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-20 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-10 md:mb-14" data-aos="fade-up">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-sm mb-4">
                    <i class="fa-solid fa-clock-rotate-left mr-1"></i> Lịch sử hình thành
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Hành Trình <span class="gradient-text">Phát Triển</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    Những cột mốc đáng nhớ trên chặng đường phát triển của King Express Travel
                </p>
            </div>

            <div class="relative max-w-4xl mx-auto">
                {{-- Center Line --}}
                <div
                    class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-primary/20 via-primary/50 to-primary/20 hidden md:block">
                </div>

                <div class="space-y-8 md:space-y-12">
                    @foreach($timeline as $index => $item)
                        <div
                            class="timeline-item relative flex flex-col md:flex-row items-center {{ $index % 2 == 0 ? 'md:flex-row-reverse' : '' }}">
                            {{-- Dot --}}
                            <div
                                class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 rounded-full bg-white border-4 border-primary z-10 hidden md:block shadow-lg box-content">
                            </div>

                            {{-- Content --}}
                            <div class="w-full md:w-1/2 {{ $index % 2 == 0 ? 'md:pl-12' : 'md:pr-12' }}">
                                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group"
                                    data-aos="{{ $index % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                                    <div
                                        class="absolute top-0 right-0 p-4 opacity-10 font-black text-6xl text-primary leading-none -translate-y-2 translate-x-2 select-none group-hover:scale-110 transition-transform">
                                        {{ $item['year'] }}
                                    </div>
                                    <div class="relative z-10">
                                        <span
                                            class="inline-block px-3 py-1 bg-primary text-white text-xs font-bold rounded-lg mb-2">
                                            {{ $item['year'] }}
                                        </span>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item['title'] }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $item['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>



    {{-- ==================== CTA SECTION ==================== --}}
    <section
        class="py-12 md:py-16 lg:py-20 bg-gradient-to-r from-primary via-amber-500 to-primary-dark relative overflow-hidden">
        {{-- Background pattern --}}
        <div class="absolute inset-0">
            <div class="absolute inset-0 opacity-20"
                style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 50px 50px;">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center" data-aos="zoom-in">
                <div
                    class="w-20 h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-plane-departure text-4xl text-white"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4">
                    Sẵn Sàng Cho Chuyến Đi Tiếp Theo?
                </h2>
                <p class="text-white/90 text-base md:text-lg lg:text-xl mb-8">
                    Hãy để King Express đồng hành cùng bạn trên mọi hành trình!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-primary-dark font-bold rounded-2xl hover:bg-gray-100 transition-all duration-300 shadow-xl text-lg">
                        <i class="fa-solid fa-compass"></i>
                        Khám phá Tour
                    </a>
                    <a href="{{ route('client.contact') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-2xl border-2 border-white/30 hover:bg-white/20 transition-all duration-300">
                        <i class="fa-solid fa-paper-plane"></i>
                        Liên hệ tư vấn
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Hero gradient text */
        .gradient-text-hero {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-text {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        /* Typed.js cursor */
        .typed-cursor {
            color: #f59e0b;
            font-weight: 100;
        }

        /* Gradient animation */
        @keyframes gradient {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .animate-gradient {
            animation: gradient 8s ease infinite;
        }

        /* Card hover effects */
        .stat-card,
        .value-card,
        .feature-card,
        .team-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover,
        .value-card:hover {
            transform: translateY(-8px);
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        /* Gallery slider */
        .gallery-slider .swiper-slide {
            width: 280px;
            height: auto;
        }

        @media (min-width: 768px) {
            .gallery-slider .swiper-slide {
                width: 350px;
            }
        }

        @media (min-width: 1024px) {
            .gallery-slider .swiper-slide {
                width: 400px;
            }
        }

        .gallery-slider .swiper-pagination-bullet,
        .testimonial-slider .swiper-pagination-bullet {
            background: rgba(245, 158, 11, 0.3);
            opacity: 1;
        }

        .gallery-slider .swiper-pagination-bullet-active,
        .testimonial-slider .swiper-pagination-bullet-active {
            background: #f59e0b;
        }

        /* Testimonial slider */
        .testimonial-slider .swiper-slide {
            height: auto;
        }

        /* Timeline responsive */
        @media (max-width: 767px) {
            .timeline-item {
                padding-left: 0;
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- Typed.js for typing effect -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Typed.js for hero section
            const typedPhrases = @json($heroTypingPhrases);

            if (document.getElementById('about-typed-text')) {
                new Typed('#about-typed-text', {
                    strings: typedPhrases,
                    typeSpeed: 60,
                    backSpeed: 40,
                    backDelay: 2000,
                    loop: true,
                    showCursor: true,
                    cursorChar: '|'
                });
            }



            // Stats Counter Animation
            const statCounters = document.querySelectorAll('.stat-counter');

            const animateCounter = (element) => {
                const target = parseInt(element.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        element.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        element.textContent = target.toLocaleString();
                    }
                };

                updateCounter();
            };

            // Intersection Observer for counters
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            statCounters.forEach(counter => counterObserver.observe(counter));

            // GSAP animations for timeline (if GSAP is available)
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.utils.toArray('.timeline-item').forEach((item, i) => {
                    gsap.from(item, {
                        opacity: 0,
                        x: i % 2 === 0 ? -50 : 50,
                        duration: 0.8,
                        scrollTrigger: {
                            trigger: item,
                            start: 'top 80%',
                        }
                    });
                });
            }
        });
    </script>
@endpush