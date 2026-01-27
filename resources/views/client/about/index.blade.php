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
@endphp

@section('content')
    {{-- ==================== HERO SECTION ==================== --}}
    <section class="about-hero relative min-h-[45vh] sm:min-h-[50vh] md:min-h-[55vh] flex items-center justify-center overflow-hidden">
        {{-- Background with gradient and pattern --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-primary-dark to-gray-800"></div>
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%222%22 fill=%22white%22/></svg>'); background-size: 50px 50px;">
            </div>
            {{-- Animated gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 via-transparent to-amber-500/20 animate-gradient"
                style="background-size: 200% 200%;"></div>
        </div>

        {{-- Floating Elements - Reduced for cleaner look --}}
        <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden hidden sm:block">
            <div class="absolute top-16 left-[8%] text-white/8 text-4xl md:text-6xl animate-float">
                <i class="fa-solid fa-plane"></i>
            </div>
            <div class="absolute top-1/3 right-[12%] text-white/8 text-5xl md:text-7xl animate-float-slow">
                <i class="fa-solid fa-mountain-sun"></i>
            </div>
            <div class="absolute bottom-1/4 left-[15%] text-white/5 text-3xl md:text-5xl animate-float"
                style="animation-delay: 1s;">
                <i class="fa-solid fa-compass"></i>
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 text-center py-12 sm:py-14 md:py-16 lg:py-20">
            <div class="max-w-3xl mx-auto">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-4"
                    data-aos="fade-down" data-aos-duration="600">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-primary rounded-full animate-pulse"></span>
                    <span class="text-xs sm:text-sm font-medium">Từ năm {{ $companyInfo['founded_year'] }}</span>
                </div>

                {{-- Main Title --}}
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-3"
                    data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                    Về <span class="gradient-text-hero">King Express</span> Travel
                </h1>

                {{-- Typing Text --}}
                <div class="text-base sm:text-lg md:text-xl lg:text-2xl text-white/90 font-medium mb-4 h-8 sm:h-10"
                    data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
                    <span id="about-typed-text"></span>
                </div>

                {{-- Description --}}
                <p class="text-white/70 text-sm sm:text-base max-w-xl mx-auto mb-5 sm:mb-6 px-2" data-aos="fade-up"
                    data-aos-delay="200" data-aos-duration="600">
                    {{ $companyInfo['slogan'] }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 justify-center px-4 sm:px-0" data-aos="fade-up"
                    data-aos-delay="250" data-aos-duration="600">
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 bg-gradient-to-r from-primary to-amber-500 text-white font-bold text-sm sm:text-base rounded-xl hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
                        <i class="fa-solid fa-compass"></i>
                        Khám phá Tour
                    </a>
                    <a href="{{ route('client.contact') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 bg-white/10 backdrop-blur-md text-white font-bold text-sm sm:text-base rounded-xl border-2 border-white/30 hover:bg-white hover:text-gray-900 transition-all duration-300">
                        <i class="fa-solid fa-phone"></i>
                        Liên hệ ngay
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== INTRODUCTION SECTION ==================== --}}
    <section class="py-10 sm:py-12 md:py-16 lg:py-20 bg-white relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute top-0 right-0 w-48 sm:w-64 lg:w-72 h-48 sm:h-64 lg:h-72 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 sm:w-80 lg:w-96 h-64 sm:h-80 lg:h-96 bg-amber-200/15 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 xl:gap-16 items-center">
                {{-- Content Side --}}
                <div data-aos="fade-right" data-aos-duration="700">
                    <span class="inline-block px-3 py-1 sm:px-4 sm:py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-xs sm:text-sm mb-3 sm:mb-4">
                        <i class="fa-solid fa-building mr-1"></i> Giới thiệu
                    </span>
                    <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-900 mb-4 sm:mb-5 leading-tight">
                        {{ $companyInfo['name'] }}
                    </h2>
                    <p class="text-gray-600 text-sm sm:text-base md:text-lg mb-5 sm:mb-6 leading-relaxed">
                        {{ $companyInfo['description'] }}
                    </p>

                    {{-- Vision & Mission --}}
                    <div class="space-y-3 sm:space-y-4 mb-6 sm:mb-8">
                        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-primary/5 to-transparent rounded-xl border-l-4 border-primary">
                            <h4 class="font-bold text-gray-900 mb-1.5 sm:mb-2 flex items-center gap-2 text-sm sm:text-base">
                                <i class="fa-solid fa-eye text-primary text-sm"></i> Tầm nhìn
                            </h4>
                            <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">{{ $vision }}</p>
                        </div>
                        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-amber-50 to-transparent rounded-xl border-l-4 border-amber-500">
                            <h4 class="font-bold text-gray-900 mb-1.5 sm:mb-2 flex items-center gap-2 text-sm sm:text-base">
                                <i class="fa-solid fa-bullseye text-amber-500 text-sm"></i> Sứ mệnh
                            </h4>
                            <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">{{ $mission }}</p>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div class="flex items-center gap-3 sm:gap-4">
                        <span class="text-gray-600 font-medium text-sm sm:text-base">Theo dõi:</span>
                        <a href="{{ $companyInfo['facebook'] }}" target="_blank"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-600 flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 shadow-md">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="{{ $companyInfo['youtube'] }}" target="_blank"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-red-600 flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 shadow-md">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                        <a href="https://zalo.me/{{ $companyInfo['zalo'] }}" target="_blank"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-500 flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 shadow-md">
                            <i class="fa-solid fa-comment-dots text-sm"></i>
                        </a>
                    </div>
                </div>

                {{-- Stats Side --}}
                <div class="grid grid-cols-2 gap-3 sm:gap-4 md:gap-5" data-aos="fade-left" data-aos-duration="700">
                    @foreach($stats as $index => $stat)
                        <div class="stat-card group relative p-4 sm:p-5 md:p-6 bg-white rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 text-center overflow-hidden border border-gray-100"
                            data-aos="zoom-in" data-aos-delay="{{ 100 + $index * 50 }}" data-aos-duration="500">
                            <div class="absolute inset-0 bg-gradient-to-br {{ $stat['color'] }} opacity-0 group-hover:opacity-5 transition-opacity duration-300"></div>
                            <div class="relative z-10">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full bg-gradient-to-br {{ $stat['color'] }} flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:scale-105 transition-transform duration-300 shadow-md">
                                    <i class="{{ $stat['icon'] }} text-base sm:text-lg md:text-xl text-white"></i>
                                </div>
                                <div class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-0.5 sm:mb-1">
                                    <span class="stat-counter" data-count="{{ $stat['value'] }}">0</span>{{ $stat['suffix'] }}
                                </div>
                                <p class="text-gray-500 font-medium text-xs sm:text-sm">{{ $stat['label'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CORE VALUES SECTION ==================== --}}
    <section class="py-10 sm:py-12 md:py-16 lg:py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6">
            {{-- Section Header --}}
            <div class="text-center mb-8 sm:mb-10 md:mb-12" data-aos="fade-up" data-aos-duration="600">
                <span class="inline-block px-3 py-1 sm:px-4 sm:py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-xs sm:text-sm mb-3 sm:mb-4">
                    <i class="fa-solid fa-heart mr-1"></i> Giá trị cốt lõi
                </span>
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-900 mb-3 sm:mb-4">
                    Điều Làm Nên <span class="gradient-text">King Express</span>
                </h2>
                <p class="text-gray-600 max-w-lg mx-auto text-sm sm:text-base px-4 sm:px-0">
                    Những giá trị cốt lõi định hình văn hóa và cách phục vụ của chúng tôi
                </p>
            </div>

            {{-- Core Values Grid --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5 lg:gap-6">
                @foreach($coreValues as $index => $value)
                    <div class="value-card group relative p-4 sm:p-5 md:p-6 bg-white rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 text-center overflow-hidden border border-gray-100"
                        data-aos="fade-up" data-aos-delay="{{ 100 + $index * 50 }}" data-aos-duration="500">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/0 to-primary/5 group-hover:from-primary/5 group-hover:to-primary/10 transition-all duration-300"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-xl sm:rounded-2xl bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:scale-105 group-hover:rotate-3 transition-all duration-300 shadow-md shadow-primary/20">
                                <i class="{{ $value['icon'] }} text-lg sm:text-xl md:text-2xl text-white"></i>
                            </div>
                            <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 mb-1.5 sm:mb-2">{{ $value['title'] }}</h3>
                            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== WHY CHOOSE US SECTION ==================== --}}
    <section class="py-10 sm:py-12 md:py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6">
            {{-- Section Header --}}
            <div class="text-center mb-8 sm:mb-10 md:mb-12" data-aos="fade-up" data-aos-duration="600">
                <span class="inline-block px-3 py-1 sm:px-4 sm:py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-xs sm:text-sm mb-3 sm:mb-4">
                    <i class="fa-solid fa-star mr-1"></i> Tại sao chọn chúng tôi
                </span>
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-900 mb-3 sm:mb-4">
                    Lý Do Khách Hàng <span class="gradient-text">Tin Tưởng</span>
                </h2>
                <p class="text-gray-600 max-w-lg mx-auto text-sm sm:text-base px-4 sm:px-0">
                    Những cam kết vững chắc giúp bạn an tâm trên mọi hành trình
                </p>
            </div>

            {{-- Features Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 md:gap-6">
                @foreach($whyChooseUs as $index => $feature)
                    <div class="group p-4 sm:p-5 md:p-6 bg-gray-50 rounded-xl sm:rounded-2xl hover:bg-white hover:shadow-lg transition-all duration-300 border border-transparent hover:border-gray-100"
                        data-aos="fade-up" data-aos-delay="{{ 50 + $index * 50 }}" data-aos-duration="500">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300 shadow-sm">
                                <i class="{{ $feature['icon'] }} text-sm sm:text-base md:text-lg text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm sm:text-base md:text-lg font-bold text-gray-900 mb-1 sm:mb-1.5">{{ $feature['title'] }}</h3>
                                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== HISTORY TIMELINE SECTION ==================== --}}
    <section class="py-10 sm:py-12 md:py-16 lg:py-20 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-8 sm:mb-10 md:mb-12" data-aos="fade-up" data-aos-duration="600">
                <span class="inline-block px-3 py-1 sm:px-4 sm:py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-xs sm:text-sm mb-3 sm:mb-4">
                    <i class="fa-solid fa-clock-rotate-left mr-1"></i> Lịch sử hình thành
                </span>
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-900 mb-3 sm:mb-4">
                    Hành Trình <span class="gradient-text">Phát Triển</span>
                </h2>
                <p class="text-gray-600 max-w-lg mx-auto text-sm sm:text-base px-4 sm:px-0">
                    Những cột mốc đáng nhớ trên chặng đường phát triển của King Express Travel
                </p>
            </div>

            <div class="relative max-w-3xl mx-auto">
                {{-- Center Line - Desktop only --}}
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-gradient-to-b from-primary/20 via-primary/40 to-primary/20 hidden md:block"></div>

                {{-- Mobile Line --}}
                <div class="absolute left-4 sm:left-6 top-0 h-full w-0.5 bg-gradient-to-b from-primary/20 via-primary/40 to-primary/20 md:hidden"></div>

                <div class="space-y-4 sm:space-y-6 md:space-y-8">
                    @foreach($timeline as $index => $item)
                        <div class="timeline-item relative flex {{ $index % 2 == 0 ? 'md:flex-row-reverse' : 'md:flex-row' }} items-start md:items-center">
                            {{-- Dot - Desktop --}}
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 sm:w-5 sm:h-5 rounded-full bg-white border-[3px] border-primary z-10 hidden md:block shadow-md box-content"></div>

                            {{-- Dot - Mobile --}}
                            <div class="absolute left-4 sm:left-6 transform -translate-x-1/2 w-3 h-3 rounded-full bg-primary z-10 md:hidden shadow-sm"></div>

                            {{-- Content --}}
                            <div class="w-full pl-8 sm:pl-12 md:pl-0 md:w-1/2 {{ $index % 2 == 0 ? 'md:pl-8 md:pr-0' : 'md:pr-8 md:pl-0' }}">
                                <div class="bg-white p-4 sm:p-5 rounded-xl sm:rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group"
                                    data-aos="{{ $index % 2 == 0 ? 'fade-left' : 'fade-right' }}" data-aos-duration="600">
                                    <div class="absolute top-0 right-0 p-3 sm:p-4 opacity-10 font-black text-4xl sm:text-5xl md:text-6xl text-primary leading-none -translate-y-1 translate-x-1 select-none group-hover:scale-105 transition-transform duration-300">
                                        {{ $item['year'] }}
                                    </div>
                                    <div class="relative z-10">
                                        <span class="inline-block px-2 py-0.5 sm:px-2.5 sm:py-1 bg-primary text-white text-[10px] sm:text-xs font-bold rounded-md mb-1.5 sm:mb-2">
                                            {{ $item['year'] }}
                                        </span>
                                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 mb-1 sm:mb-1.5">{{ $item['title'] }}</h3>
                                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">{{ $item['desc'] }}</p>
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
    <section class="py-10 sm:py-12 md:py-16 lg:py-20 bg-gradient-to-r from-primary via-amber-500 to-primary-dark relative overflow-hidden">
        {{-- Background pattern --}}
        <div class="absolute inset-0">
            <div class="absolute inset-0 opacity-15"
                style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;">
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="max-w-2xl mx-auto text-center" data-aos="zoom-in" data-aos-duration="600">
                <div class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-4 sm:mb-5 md:mb-6">
                    <i class="fa-solid fa-plane-departure text-2xl sm:text-3xl md:text-4xl text-white"></i>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-white mb-3 sm:mb-4 px-4">
                    Sẵn Sàng Cho Chuyến Đi Tiếp Theo?
                </h2>
                <p class="text-white/90 text-sm sm:text-base md:text-lg mb-5 sm:mb-6 md:mb-8 px-4">
                    Hãy để King Express đồng hành cùng bạn trên mọi hành trình!
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center px-4 sm:px-0">
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 sm:px-7 sm:py-3.5 md:px-8 md:py-4 bg-white text-primary-dark font-bold rounded-xl sm:rounded-2xl hover:bg-gray-100 transition-all duration-300 shadow-lg text-sm sm:text-base md:text-lg">
                        <i class="fa-solid fa-compass"></i>
                        Khám phá Tour
                    </a>
                    <a href="{{ route('client.contact') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 sm:px-7 sm:py-3.5 md:px-8 md:py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl sm:rounded-2xl border-2 border-white/30 hover:bg-white/20 transition-all duration-300 text-sm sm:text-base md:text-lg">
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
        /* ==================== GRADIENT TEXT ==================== */
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

        /* ==================== FLOATING ANIMATIONS ==================== */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .animate-float {
            animation: float 5s ease-in-out infinite;
            will-change: transform;
        }

        .animate-float-slow {
            animation: float-slow 7s ease-in-out infinite;
            will-change: transform;
        }

        /* ==================== GRADIENT ANIMATION ==================== */
        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .animate-gradient {
            animation: gradient 10s ease infinite;
            will-change: background-position;
        }

        /* ==================== TYPED.JS CURSOR ==================== */
        .typed-cursor {
            color: #f59e0b;
            font-weight: 300;
            opacity: 1;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* ==================== CARD HOVER EFFECTS ==================== */
        .stat-card,
        .value-card {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }

        .stat-card:hover,
        .value-card:hover {
            transform: translateY(-4px);
        }

        /* ==================== SMOOTH SCROLL BEHAVIOR ==================== */
        @media (prefers-reduced-motion: no-preference) {
            html {
                scroll-behavior: smooth;
            }
        }

        /* Reduce animations for users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .animate-float,
            .animate-float-slow,
            .animate-gradient {
                animation: none;
            }

            .stat-card:hover,
            .value-card:hover {
                transform: none;
            }
        }

        /* ==================== TIMELINE MOBILE OPTIMIZATION ==================== */
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
            // Check for reduced motion preference
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            // ==================== TYPED.JS INITIALIZATION ====================
            const typedPhrases = @json($heroTypingPhrases);
            const typedElement = document.getElementById('about-typed-text');

            if (typedElement && !prefersReducedMotion) {
                new Typed('#about-typed-text', {
                    strings: typedPhrases,
                    typeSpeed: 50,
                    backSpeed: 30,
                    backDelay: 2500,
                    loop: true,
                    showCursor: true,
                    cursorChar: '|'
                });
            } else if (typedElement) {
                // Show first phrase without animation for reduced motion
                typedElement.textContent = typedPhrases[0];
            }

            // ==================== STATS COUNTER ANIMATION ====================
            const statCounters = document.querySelectorAll('.stat-counter');

            const animateCounter = (element) => {
                const target = parseInt(element.getAttribute('data-count'));

                // Skip animation for reduced motion
                if (prefersReducedMotion) {
                    element.textContent = target.toLocaleString('vi-VN');
                    return;
                }

                const duration = 1500;
                const startTime = performance.now();

                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    // Easing function for smooth animation
                    const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                    const current = Math.floor(target * easeOutQuart);

                    element.textContent = current.toLocaleString('vi-VN');

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    }
                };

                requestAnimationFrame(updateCounter);
            };

            // Intersection Observer for counters
            if (statCounters.length > 0) {
                const counterObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            counterObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.3,
                    rootMargin: '0px 0px -50px 0px'
                });

                statCounters.forEach(counter => counterObserver.observe(counter));
            }
        });
    </script>
@endpush