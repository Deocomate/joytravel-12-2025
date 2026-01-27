@extends('client.layouts.app')

@section('title', 'Liên hệ - King Express Travel')
@section('description', 'Liên hệ với King Express Travel để được tư vấn và hỗ trợ về các tour du lịch trong nước. Hotline: 0858446699')

@php
    // ==================== STATIC DATA ====================
    $companyInfo = [
        'name' => 'Công ty Du lịch King Express',
        'slogan' => 'Đồng hành cùng mọi hành trình của bạn',
        'description' => 'King Express Travel là đơn vị lữ hành chuyên nghiệp hàng đầu, chuyên cung cấp các tour du lịch nội địa chất lượng cao. Với nhiều năm kinh nghiệm trong ngành, chúng tôi cam kết mang đến những trải nghiệm du lịch tuyệt vời nhất cho quý khách.',
        'phone' => '0858446699',
        'email' => 'kingexpressbus@gmail.com',
        'hotline' => '0858446699',
        'zalo' => '0858446699',
        'working_hours' => 'Thứ 2 - Thứ 7: 8:00 - 17:30',
        'facebook' => 'https://facebook.com/kingexpresstravel',
        'youtube' => 'https://youtube.com/@kingexpresstravel',
    ];

    $office = [
        'name' => 'Trụ sở chính Hà Nội',
        'address' => '19 Hàng Thiếc, Phường Hoàn Kiếm, Thành Phố Hà Nội',
        'phone' => '0858446699',
        'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.096947669847!2d105.84772731533215!3d21.03084898599492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abbfd46c57af%3A0xe0a0e6b9e12d5a62!2zMTkgSMOgbmcgVGhp4bq_YywgSMOgbmcgR2FpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1703149200000!5m2!1svi!2s',
    ];

    $stats = [
        ['icon' => 'fa-solid fa-route', 'value' => 50, 'suffix' => '+', 'label' => 'Tour du lịch', 'color' => 'from-primary to-amber-400'],
        ['icon' => 'fa-solid fa-location-dot', 'value' => 30, 'suffix' => '+', 'label' => 'Điểm đến', 'color' => 'from-blue-500 to-cyan-400'],
        ['icon' => 'fa-solid fa-users', 'value' => 1000, 'suffix' => '+', 'label' => 'Khách hàng', 'color' => 'from-green-500 to-emerald-400'],
        ['icon' => 'fa-solid fa-award', 'value' => 10, 'suffix' => '+', 'label' => 'Năm kinh nghiệm', 'color' => 'from-purple-500 to-pink-400'],
    ];

    $heroTypingPhrases = [
        'Chúng tôi luôn lắng nghe bạn',
        'Hỗ trợ 24/7 mọi lúc mọi nơi',
        'Đồng hành cùng hành trình của bạn',
        'Tư vấn miễn phí - Giá tốt nhất',
    ];

    $features = [
        ['icon' => 'fa-solid fa-headset', 'title' => 'Tư vấn chuyên nghiệp', 'desc' => 'Đội ngũ tư vấn viên giàu kinh nghiệm, sẵn sàng hỗ trợ bạn 24/7'],
        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'An toàn tuyệt đối', 'desc' => 'Cam kết bảo mật thông tin và đảm bảo an toàn cho khách hàng'],
        ['icon' => 'fa-solid fa-coins', 'title' => 'Giá cả minh bạch', 'desc' => 'Không phát sinh chi phí ẩn, giá niêm yết rõ ràng'],
        ['icon' => 'fa-solid fa-rotate-left', 'title' => 'Hoàn tiền linh hoạt', 'desc' => 'Chính sách hoàn hủy linh hoạt, bảo vệ quyền lợi khách hàng'],
    ];

    $galleryImages = [
        ['src' => 'client/images/cities/hanoi/tp.jpg', 'alt' => 'Du lịch Hà Nội'],
        ['src' => 'client/images/cities/hochiminh/tphcm.jpg', 'alt' => 'Khám phá TP.HCM'],
        ['src' => 'client/images/cities/quangninh/halongbay.webp', 'alt' => 'Vịnh Hạ Long'],
        ['src' => 'client/images/cities/hue/kinhthanh.jpg', 'alt' => 'Cố đô Huế'],
        ['src' => 'client/images/cities/ninhbinh/trangan.jpg', 'alt' => 'Tràng An Ninh Bình'],
        ['src' => 'client/images/cities/thanhhoa/th bien.jpg', 'alt' => 'Biển Sầm Sơn'],
    ];

    $faqItems = [
        [
            'question' => 'Làm thế nào để đặt tour tại King Express?',
            'answer' => 'Quý khách có thể đặt tour trực tuyến trên website, liên hệ qua hotline 0858446699, hoặc đến trực tiếp văn phòng chúng tôi tại 19 Hàng Thiếc, Hoàn Kiếm, Hà Nội. Nhân viên tư vấn sẽ hỗ trợ bạn chọn tour phù hợp nhất.',
        ],
        [
            'question' => 'Chính sách hoàn hủy tour như thế nào?',
            'answer' => 'Chúng tôi có chính sách hoàn hủy linh hoạt: Hủy trước 7 ngày được hoàn 100%, trước 3-7 ngày hoàn 70%, trước 1-3 ngày hoàn 50%. Trường hợp bất khả kháng sẽ được xem xét riêng.',
        ],
        [
            'question' => 'Có cần đặt cọc khi đăng ký tour không?',
            'answer' => 'Có, để đảm bảo giữ chỗ, quý khách cần đặt cọc 30-50% giá trị tour. Phần còn lại thanh toán trước ngày khởi hành theo thỏa thuận.',
        ],
        [
            'question' => 'Tour có bao gồm bảo hiểm du lịch không?',
            'answer' => 'Có, tất cả các tour của King Express đều bao gồm bảo hiểm du lịch cơ bản. Quý khách có thể nâng cấp gói bảo hiểm với chi phí hợp lý.',
        ],
        [
            'question' => 'Làm sao để nhận ưu đãi giảm giá?',
            'answer' => 'Quý khách có thể theo dõi fanpage Facebook, đăng ký nhận newsletter, hoặc đặt tour theo nhóm đông để nhận các ưu đãi hấp dẫn từ King Express.',
        ],
    ];

    $serviceTypes = [
        'Liên hệ thông tin Tour Trong Nước',
        'Đặt tour du lịch',
        'Góp ý chất lượng dịch vụ',
        'Hỗ trợ kỹ thuật',
        'Hợp tác kinh doanh',
        'Khác',
    ];
@endphp

@section('content')
    {{-- ==================== FLOATING QUICK ACTIONS (Mobile) ==================== --}}
    <div class="fixed bottom-20 right-4 z-50 flex flex-col gap-3 md:hidden" x-data="{ showActions: true }">
        {{-- Zalo Button --}}
        <a href="https://zalo.me/{{ $companyInfo['zalo'] }}" target="_blank"
            class="w-14 h-14 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-lg shadow-blue-500/40 hover:scale-110 transition-transform duration-300"
            x-show="showActions" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
            aria-label="Chat Zalo">
            <i class="fa-solid fa-comment-dots text-xl"></i>
        </a>
        {{-- Hotline Button --}}
        <a href="tel:{{ $companyInfo['hotline'] }}"
            class="w-14 h-14 rounded-full bg-gradient-to-br from-primary to-amber-500 text-white flex items-center justify-center shadow-lg shadow-primary/40 hover:scale-110 transition-transform duration-300 animate-pulse-slow"
            x-show="showActions" x-transition:enter="transition ease-out duration-300 delay-100"
            x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
            aria-label="Gọi hotline">
            <i class="fa-solid fa-phone-volume text-xl"></i>
        </a>
    </div>

    {{-- ==================== HERO SECTION ==================== --}}
    <section class="contact-hero relative min-h-[55vh] md:min-h-[65vh] flex items-center justify-center overflow-hidden pb-12 md:pb-16">
        {{-- Background with gradient and pattern --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-primary-dark"></div>
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 80 80%22><path d=%22M0 0h80v80H0z%22 fill=%22none%22/><circle cx=%2240%22 cy=%2240%22 r=%222%22 fill=%22white%22/></svg>'); background-size: 80px 80px;">
            </div>
            {{-- Animated gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 via-transparent to-amber-500/20 animate-gradient"
                style="background-size: 200% 200%;"></div>
        </div>

        {{-- Floating Elements --}}
        <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
            <div class="absolute top-1/4 left-10 text-white/10 text-5xl md:text-7xl animate-float">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="absolute top-1/3 right-16 text-white/10 text-6xl md:text-8xl animate-float-slow">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div class="absolute bottom-1/4 left-1/4 text-white/5 text-4xl md:text-6xl animate-float"
                style="animation-delay: 1s;">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="absolute bottom-1/3 right-1/4 text-white/5 text-5xl md:text-7xl animate-float-slow"
                style="animation-delay: 2s;">
                <i class="fa-solid fa-comments"></i>
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-20 container mx-auto px-4 text-center pt-20 md:pt-24">
            <div class="max-w-4xl mx-auto">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-6"
                    data-aos="fade-down">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium">Sẵn sàng hỗ trợ bạn 24/7</span>
                </div>

                {{-- Main Title --}}
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 md:mb-6"
                    data-aos="fade-up" data-aos-delay="100">
                    Liên Hệ <span class="gradient-text-hero">King Express</span>
                </h1>

                {{-- Typing Text --}}
                <div class="text-lg sm:text-xl md:text-2xl lg:text-3xl text-white/90 font-medium mb-6 md:mb-8 h-10 md:h-12"
                    data-aos="fade-up" data-aos-delay="200">
                    <span id="contact-typed-text"></span>
                </div>

                {{-- Description --}}
                <p class="text-white/70 text-sm md:text-base lg:text-lg max-w-2xl mx-auto mb-8" data-aos="fade-up"
                    data-aos-delay="300">
                    Đội ngũ tư vấn viên chuyên nghiệp của chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn.
                </p>

                {{-- Quick Contact Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                    <a href="tel:{{ $companyInfo['hotline'] }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-primary to-amber-500 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 transform hover:scale-105">
                        <i class="fa-solid fa-phone-volume animate-pulse"></i>
                        Gọi ngay: {{ $companyInfo['hotline'] }}
                    </a>
                    <a href="https://zalo.me/{{ $companyInfo['zalo'] }}" target="_blank"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/10 backdrop-blur-md text-white font-bold rounded-xl border-2 border-white/30 hover:bg-white hover:text-gray-900 transition-all duration-300">
                        <i class="fa-solid fa-comment-dots"></i>
                        Chat Zalo
                    </a>
                </div>

                {{-- Social Links --}}
                <div class="flex items-center justify-center gap-4 mt-8" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ $companyInfo['facebook'] }}" target="_blank"
                        class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm text-white flex items-center justify-center hover:bg-blue-600 hover:scale-110 transition-all duration-300"
                        aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f text-lg"></i>
                    </a>
                    <a href="{{ $companyInfo['youtube'] }}" target="_blank"
                        class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm text-white flex items-center justify-center hover:bg-red-600 hover:scale-110 transition-all duration-300"
                        aria-label="YouTube">
                        <i class="fa-brands fa-youtube text-lg"></i>
                    </a>
                    <a href="mailto:{{ $companyInfo['email'] }}"
                        class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm text-white flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300"
                        aria-label="Email">
                        <i class="fa-solid fa-envelope text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== QUICK INFO BAR ==================== --}}
    <section class="bg-white border-y border-gray-200 py-5 md:py-6 shadow-sm" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-4 text-sm md:text-base">
                <a href="tel:{{ $companyInfo['hotline'] }}"
                    class="flex items-center gap-2.5 text-gray-700 hover:text-primary transition-colors group">
                    <span class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary transition-colors">
                        <i class="fa-solid fa-phone text-primary group-hover:text-white transition-colors"></i>
                    </span>
                    <span class="font-bold text-lg">{{ $companyInfo['hotline'] }}</span>
                </a>
                <span class="hidden sm:block w-px h-8 bg-gray-200"></span>
                <a href="mailto:{{ $companyInfo['email'] }}"
                    class="flex items-center gap-2.5 text-gray-700 hover:text-primary transition-colors group">
                    <span class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                        <i class="fa-solid fa-envelope text-blue-500 group-hover:text-white transition-colors"></i>
                    </span>
                    <span class="font-medium">{{ $companyInfo['email'] }}</span>
                </a>
                <span class="hidden md:block w-px h-8 bg-gray-200"></span>
                <div class="flex items-center gap-2.5 text-gray-600">
                    <span class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                        <i class="fa-regular fa-clock text-green-500"></i>
                    </span>
                    <span class="font-medium">{{ $companyInfo['working_hours'] }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CONTACT CARDS SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-20 bg-gray-50 relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute top-0 right-0 w-72 h-72 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-amber-200/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-sm mb-4">
                    <i class="fa-solid fa-phone-flip mr-1"></i> Kênh liên lạc
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Kết Nối Với <span class="gradient-text">Chúng Tôi</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    Chọn cách liên hệ phù hợp nhất với bạn - Chúng tôi luôn sẵn sàng hỗ trợ
                </p>
            </div>

            {{-- Contact Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                {{-- Hotline Card - Primary highlight --}}
                <a href="tel:{{ $companyInfo['hotline'] }}"
                    class="contact-card group relative p-6 bg-gradient-to-br from-primary to-amber-500 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden cursor-pointer lg:col-span-1 sm:col-span-2 lg:order-none"
                    data-aos="fade-up" data-aos-delay="0">
                    <div class="absolute inset-0 bg-white/0 group-hover:bg-white/10 transition-all duration-500"></div>
                    {{-- Decorative circles --}}
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-white/10 rounded-full"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-white/10 rounded-full"></div>
                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-headphones-simple text-3xl text-white"></i>
                        </div>
                        <span class="text-white/80 text-sm font-medium uppercase tracking-wide">Hotline 24/7</span>
                        <p class="text-white font-black text-2xl md:text-3xl mt-1">{{ $companyInfo['hotline'] }}</p>
                        <p class="text-white/80 text-sm mt-2 flex items-center gap-2">
                            <i class="fa-solid fa-phone-volume animate-pulse"></i>
                            Gọi ngay để được tư vấn miễn phí
                        </p>
                    </div>
                </a>

                {{-- Email Card --}}
                <a href="mailto:{{ $companyInfo['email'] }}"
                    class="contact-card group relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden cursor-pointer"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50/0 to-blue-50 group-hover:from-blue-50 group-hover:to-blue-100 transition-all duration-500">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-blue-500/30">
                            <i class="fa-solid fa-envelope text-2xl text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                        <p class="text-blue-600 font-semibold text-sm mb-1 break-all">{{ $companyInfo['email'] }}</p>
                        <p class="text-gray-500 text-sm">Phản hồi trong 24h</p>
                    </div>
                    <div
                        class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                        <i class="fa-solid fa-arrow-right text-blue-500"></i>
                    </div>
                </a>

                {{-- Zalo Card --}}
                <a href="https://zalo.me/{{ $companyInfo['zalo'] }}" target="_blank"
                    class="contact-card group relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden cursor-pointer"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50/0 to-blue-50 group-hover:from-blue-50 group-hover:to-blue-100 transition-all duration-500">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-blue-600/30">
                            <i class="fa-solid fa-comment-dots text-2xl text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Zalo</h3>
                        <p class="text-blue-600 font-bold text-xl mb-1">{{ $companyInfo['zalo'] }}</p>
                        <p class="text-gray-500 text-sm">Chat trực tiếp</p>
                    </div>
                    <div
                        class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                        <i class="fa-solid fa-arrow-right text-blue-600"></i>
                    </div>
                </a>

                {{-- Office Card --}}
                <a href="https://maps.google.com/?q={{ urlencode($office['address']) }}" target="_blank"
                    class="contact-card group relative p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden cursor-pointer"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50/0 to-green-50 group-hover:from-green-50 group-hover:to-green-100 transition-all duration-500">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-green-500 to-emerald-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-green-500/30">
                            <i class="fa-solid fa-location-dot text-2xl text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Văn phòng</h3>
                        <p class="text-gray-700 text-sm mb-1 line-clamp-2">{{ $office['address'] }}</p>
                        <p class="text-gray-500 text-sm">{{ $companyInfo['working_hours'] }}</p>
                    </div>
                    <div
                        class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                        <i class="fa-solid fa-directions text-green-600"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ==================== STATS SECTION ==================== --}}
    <section class="py-10 md:py-14 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                @foreach($stats as $index => $stat)
                    <div class="text-center p-4 md:p-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br {{ $stat['color'] }} flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="{{ $stat['icon'] }} text-2xl md:text-3xl text-white"></i>
                        </div>
                        <div class="text-2xl md:text-4xl font-black text-gray-900 mb-1">
                            <span class="stat-counter" data-count="{{ $stat['value'] }}">0</span>{{ $stat['suffix'] }}
                        </div>
                        <p class="text-gray-600 text-sm md:text-base font-medium">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== WHY CHOOSE US SECTION ==================== --}}
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <span
                    class="inline-block px-4 py-1.5 bg-green-100 text-green-600 font-semibold rounded-full text-sm mb-4">
                    <i class="fa-solid fa-star mr-1"></i> Cam kết của chúng tôi
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Tại Sao Chọn <span class="gradient-text">King Express</span>?
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Chúng tôi cam kết mang đến dịch vụ tốt nhất với sự chuyên nghiệp và tận tâm
                </p>
            </div>

            {{-- Features Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($features as $index => $feature)
                    <div class="group p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 cursor-pointer"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                            <i class="{{ $feature['icon'] }} text-2xl text-primary group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    {{-- ==================== MAP & OFFICE SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <span
                    class="inline-block px-4 py-1.5 bg-green-100 text-green-600 font-semibold rounded-full text-sm mb-4">
                    <i class="fa-solid fa-map-location-dot mr-1"></i> Địa điểm
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Ghé Thăm <span class="gradient-text">Văn Phòng</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    Đến trực tiếp để được tư vấn và trải nghiệm dịch vụ tốt nhất
                </p>
            </div>

            <div class="grid lg:grid-cols-5 gap-8 items-stretch">
                {{-- Office Info Card --}}
                <div class="lg:col-span-2" data-aos="fade-right">
                    <div class="bg-gray-50 rounded-2xl p-6 md:p-8 h-full border border-gray-100">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span
                                class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-building text-white"></i>
                            </span>
                            {{ $office['name'] }}
                        </h3>

                        <div class="space-y-4 mb-8">
                            {{-- Address --}}
                            <div
                                class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-100 hover:shadow-md transition-shadow cursor-pointer">
                                <div
                                    class="w-11 h-11 rounded-lg bg-gradient-to-br from-green-500 to-emerald-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <i class="fa-solid fa-location-dot text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1 text-sm uppercase tracking-wide">Địa chỉ
                                    </h4>
                                    <p class="text-gray-700">{{ $office['address'] }}</p>
                                </div>
                            </div>

                            {{-- Phone --}}
                            <a href="tel:{{ $office['phone'] }}"
                                class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-100 hover:shadow-md hover:border-primary/30 transition-all cursor-pointer group">
                                <div
                                    class="w-11 h-11 rounded-lg bg-gradient-to-br from-primary to-amber-400 flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1 text-sm uppercase tracking-wide">Điện thoại
                                    </h4>
                                    <p class="text-primary font-bold text-lg group-hover:underline">
                                        {{ $office['phone'] }}</p>
                                </div>
                            </a>

                            {{-- Working Hours --}}
                            <div
                                class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-100 hover:shadow-md transition-shadow cursor-pointer">
                                <div
                                    class="w-11 h-11 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <i class="fa-regular fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1 text-sm uppercase tracking-wide">Giờ làm
                                        việc</h4>
                                    <p class="text-gray-700">{{ $companyInfo['working_hours'] }}</p>
                                    <p class="text-green-600 text-sm font-medium mt-1 flex items-center gap-1">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                        Đang mở cửa
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="https://maps.google.com/?q={{ urlencode($office['address']) }}" target="_blank"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:scale-[1.02]">
                                <i class="fa-solid fa-directions"></i>
                                Chỉ đường
                            </a>
                            <a href="tel:{{ $office['phone'] }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-white text-gray-900 font-bold rounded-xl border-2 border-gray-200 hover:border-primary hover:text-primary transition-all duration-300">
                                <i class="fa-solid fa-phone"></i>
                                Gọi ngay
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Map --}}
                <div class="lg:col-span-3" data-aos="fade-left">
                    <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white h-full min-h-[400px]">
                        <iframe src="{{ $office['map_embed'] }}" width="100%" height="100%" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full min-h-[400px]"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- ==================== CONTACT FORM SECTION ==================== --}}
    <section class="py-12 md:py-16 lg:py-24 bg-gray-50 relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-72 h-72 bg-amber-200/30 rounded-full blur-3xl translate-x-1/2 translate-y-1/2">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-10 md:mb-12" data-aos="fade-up">
                <span
                    class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-semibold rounded-full text-sm mb-4">
                    <i class="fa-solid fa-paper-plane mr-1"></i> Liên hệ trực tuyến
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Gửi Tin Nhắn Cho <span class="gradient-text">Chúng Tôi</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    Điền thông tin bên dưới, chúng tôi sẽ liên hệ lại trong thời gian sớm nhất
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-start">
                {{-- Form Side --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100" data-aos="fade-right">
                    {{-- Success message --}}
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3"
                            data-aos="fade-in">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold">Gửi thành công!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Error messages --}}
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                            <div class="flex items-center gap-2 font-bold mb-2">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                Vui lòng kiểm tra lại thông tin
                            </div>
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('client.contact.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Service Type --}}
                        <div class="relative group">
                            <label for="service_type" class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fa-solid fa-list-check mr-1.5 text-primary"></i> Bạn cần hỗ trợ gì?
                            </label>
                            <select id="service_type" name="service_type"
                                class="w-full px-4 py-3.5 pr-10 rounded-xl border-2 border-gray-200 bg-white appearance-none cursor-pointer focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 text-gray-700 font-medium">
                                @foreach($serviceTypes as $type)
                                    <option value="{{ $type }}" {{ old('service_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-[46px] pointer-events-none text-gray-400">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        {{-- Full Name --}}
                        <div class="relative group">
                            <label for="full_name" class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fa-solid fa-user mr-1.5 text-primary"></i> Họ và tên <span
                                    class="text-red-500">*</span>
                            </label>
                            <input type="text" name="full_name" id="full_name"
                                value="{{ old('full_name', auth()->user()->name ?? '') }}" required
                                class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300"
                                placeholder="Nhập họ và tên của bạn">
                        </div>

                        {{-- Email & Phone Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="relative group">
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-envelope mr-1.5 text-primary"></i> Email <span
                                        class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', auth()->user()->email ?? '') }}" required
                                    class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300"
                                    placeholder="email@example.com">
                            </div>
                            <div class="relative group">
                                <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-phone mr-1.5 text-primary"></i> Số điện thoại <span
                                        class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="phone" id="phone"
                                    value="{{ old('phone', auth()->user()->phone ?? '') }}" required
                                    class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300"
                                    placeholder="0xxx xxx xxx">
                            </div>
                        </div>

                        {{-- Note --}}
                        <div class="relative group">
                            <label for="note" class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fa-solid fa-sticky-note mr-1.5 text-primary"></i> Ghi chú
                                <span class="text-gray-400 font-normal">(không bắt buộc)</span>
                            </label>
                            <input type="text" name="note" id="note" value="{{ old('note') }}"
                                class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300"
                                placeholder="VD: Tour Hạ Long 3N2Đ cho 4 người...">
                        </div>

                        {{-- Message --}}
                        <div class="relative group">
                            <label for="message" class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fa-solid fa-message mr-1.5 text-primary"></i> Nội dung chi tiết <span
                                    class="text-red-500">*</span>
                            </label>
                            <textarea name="message" id="message" rows="5" required
                                class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 resize-none"
                                placeholder="Mô tả chi tiết yêu cầu của bạn...">{{ old('message') }}</textarea>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                            class="w-full relative px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-xl overflow-hidden transform hover:scale-[1.02] hover:shadow-xl hover:shadow-primary/30 active:scale-[0.98] transition-all duration-300 group">
                            <span class="relative z-10 flex items-center justify-center gap-2 text-lg">
                                <i class="fa-solid fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                                Gửi yêu cầu
                            </span>
                            <div
                                class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700">
                            </div>
                        </button>

                        {{-- Privacy note --}}
                        <p class="text-center text-gray-500 text-xs mt-4">
                            <i class="fa-solid fa-shield-halved mr-1"></i>
                            Thông tin của bạn được bảo mật tuyệt đối
                        </p>
                    </form>
                </div>

                {{-- FAQ Side --}}
                <div data-aos="fade-left">
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="inline-block px-4 py-1.5 bg-blue-100 text-blue-600 font-semibold rounded-full text-sm">
                            <i class="fa-solid fa-circle-question mr-1"></i> FAQ
                        </span>
                    </div>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900 mb-6">
                        Câu Hỏi Thường Gặp
                    </h3>

                    <div class="space-y-3" x-data="{ openFaq: 0 }">
                        @foreach($faqItems as $index => $faq)
                            <div class="faq-item bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow"
                                data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                                <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                                    class="w-full flex items-center justify-between p-4 md:p-5 text-left hover:bg-gray-50 transition-colors cursor-pointer">
                                    <span class="font-bold text-gray-900 pr-4 text-sm md:text-base">{{ $faq['question'] }}</span>
                                    <div
                                        class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 transition-all duration-300"
                                        :class="{ 'bg-primary': openFaq === {{ $index }} }">
                                        <i class="fa-solid fa-chevron-down text-sm transition-all duration-300"
                                            :class="{ 'rotate-180 text-white': openFaq === {{ $index }}, 'text-primary': openFaq !== {{ $index }} }"></i>
                                    </div>
                                </button>
                                <div x-show="openFaq === {{ $index }}" x-collapse x-cloak class="px-4 md:px-5 pb-4 md:pb-5">
                                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">{{ $faq['answer'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Quick Help Box --}}
                    <div class="mt-8 p-5 bg-gradient-to-br from-primary/5 to-amber-50 rounded-2xl border border-primary/10"
                        data-aos="fade-up" data-aos-delay="300">
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-lightbulb text-primary"></i>
                            Cần hỗ trợ nhanh hơn?
                        </h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Liên hệ trực tiếp qua Hotline hoặc Zalo để được tư vấn ngay lập tức!
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="tel:{{ $companyInfo['hotline'] }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark transition-colors text-sm">
                                <i class="fa-solid fa-phone"></i>
                                {{ $companyInfo['hotline'] }}
                            </a>
                            <a href="https://zalo.me/{{ $companyInfo['zalo'] }}" target="_blank"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                <i class="fa-solid fa-comment-dots"></i>
                                Chat Zalo
                            </a>
                        </div>
                    </div>
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
        {{-- Decorative circles --}}
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white/10 rounded-full blur-xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center" data-aos="zoom-in">
                <div
                    class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-6 animate-bounce-slow">
                    <i class="fa-solid fa-headset text-4xl md:text-5xl text-white"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4">
                    Bạn Cần Hỗ Trợ Ngay?
                </h2>
                <p class="text-white/90 text-base md:text-lg lg:text-xl mb-8 max-w-2xl mx-auto">
                    Đội ngũ tư vấn viên của chúng tôi luôn sẵn sàng hỗ trợ bạn 24/7.
                    <span class="block mt-2 text-white/70">Tư vấn miễn phí - Không cam kết</span>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:{{ $companyInfo['hotline'] }}"
                        class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-primary-dark font-bold rounded-2xl hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-xl text-lg group">
                        <i class="fa-solid fa-phone-volume group-hover:animate-pulse"></i>
                        <span>Gọi: <span class="font-black">{{ $companyInfo['hotline'] }}</span></span>
                    </a>
                    <a href="{{ route('client.tours') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-2xl border-2 border-white/30 hover:bg-white/20 hover:scale-105 transition-all duration-300">
                        <i class="fa-solid fa-compass"></i>
                        Khám phá Tour
                    </a>
                </div>

                {{-- Social Links --}}
                <div class="flex items-center justify-center gap-4 mt-10">
                    <span class="text-white/70 text-sm hidden sm:inline">Theo dõi chúng tôi:</span>
                    <a href="{{ $companyInfo['facebook'] }}" target="_blank"
                        class="w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white hover:text-blue-600 transition-all duration-300 hover:scale-110"
                        aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f text-lg"></i>
                    </a>
                    <a href="{{ $companyInfo['youtube'] }}" target="_blank"
                        class="w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white hover:text-red-600 transition-all duration-300 hover:scale-110"
                        aria-label="YouTube">
                        <i class="fa-brands fa-youtube text-lg"></i>
                    </a>
                    <a href="https://zalo.me/{{ $companyInfo['zalo'] }}" target="_blank"
                        class="w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white hover:text-blue-500 transition-all duration-300 hover:scale-110"
                        aria-label="Zalo">
                        <i class="fa-solid fa-comment-dots text-lg"></i>
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

        /* Floating animations */
        @@keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @@keyframes float-slow {

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
        @@keyframes gradient {

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

        /* Contact card hover effect */
        .contact-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .contact-card:hover {
            transform: translateY(-8px);
        }

        /* FAQ item transitions */
        .faq-item button {
            min-height: 60px;
        }

        /* Quick info bar sticky behavior */
        @@supports (position: sticky) {
            section.sticky {
                position: sticky;
            }
        }

        /* Form input focus styles */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
        }

        /* Stats counter animation */
        .stat-counter {
            display: inline-block;
        }

        /* Smooth scroll offset for sticky header */
        html {
            scroll-padding-top: 140px;
        }

        /* Gallery slider */
        .gallery-slider .swiper-slide {
            width: 300px;
            height: auto;
        }

        @@media (min-width: 768px) {
            .gallery-slider .swiper-slide {
                width: 400px;
            }
        }

        .gallery-slider .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
        }

        .gallery-slider .swiper-pagination-bullet-active {
            background: #f59e0b;
        }

        /* Alpine x-collapse */
        [x-cloak] {
            display: none !important;
        }

        /* Mobile floating buttons safe area */
        @@supports (padding-bottom: env(safe-area-inset-bottom)) {
            .fixed.bottom-20 {
                bottom: calc(5rem + env(safe-area-inset-bottom, 0px));
            }
        }

        /* Pulse slow animation for mobile CTA */
        @@keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.9;
                transform: scale(1.05);
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Bounce slow animation */
        @@keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
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

            if (document.getElementById('contact-typed-text')) {
                new Typed('#contact-typed-text', {
                    strings: typedPhrases,
                    typeSpeed: 60,
                    backSpeed: 40,
                    backDelay: 2000,
                    loop: true,
                    showCursor: true,
                    cursorChar: '|'
                });
            }

            // Initialize Gallery Swiper
            if (document.querySelector('.gallery-slider')) {
                new Swiper('.gallery-slider', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    centeredSlides: true,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            spaceBetween: 24,
                        },
                    },
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
        });
    </script>
@endpush