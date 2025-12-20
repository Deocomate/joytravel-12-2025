{{-- Animated Wave Decoration --}}
<div class="bg-gray-50 overflow-hidden">
    <svg class="w-full h-20 md:h-28 -mb-1" viewBox="0 0 1440 100" preserveAspectRatio="none">
        <defs>
            <linearGradient id="footer-wave-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#fef3c7">
                    <animate attributeName="stop-color" values="#fef3c7;#fbbf24;#fef3c7" dur="4s"
                        repeatCount="indefinite" />
                </stop>
                <stop offset="50%" style="stop-color:#fff7ed">
                    <animate attributeName="stop-color" values="#fff7ed;#fef3c7;#fff7ed" dur="4s"
                        repeatCount="indefinite" />
                </stop>
                <stop offset="100%" style="stop-color:#ffffff" />
            </linearGradient>
        </defs>
        <path fill="url(#footer-wave-gradient)"
            d="M0,60 C360,100 720,20 1080,60 C1260,80 1380,50 1440,40 L1440,100 L0,100 Z">
            <animate attributeName="d" values="M0,60 C360,100 720,20 1080,60 C1260,80 1380,50 1440,40 L1440,100 L0,100 Z;
                        M0,40 C360,20 720,80 1080,40 C1260,20 1380,60 1440,50 L1440,100 L0,100 Z;
                        M0,60 C360,100 720,20 1080,60 C1260,80 1380,50 1440,40 L1440,100 L0,100 Z" dur="8s"
                repeatCount="indefinite" />
        </path>
        <path fill="#ffffff" opacity="0.6" d="M0,80 C400,40 800,90 1200,50 C1320,40 1380,60 1440,55 L1440,100 L0,100 Z">
            <animate attributeName="d" values="M0,80 C400,40 800,90 1200,50 C1320,40 1380,60 1440,55 L1440,100 L0,100 Z;
                        M0,70 C400,90 800,40 1200,70 C1320,80 1380,50 1440,60 L1440,100 L0,100 Z;
                        M0,80 C400,40 800,90 1200,50 C1320,40 1380,60 1440,55 L1440,100 L0,100 Z" dur="6s"
                repeatCount="indefinite" />
        </path>
    </svg>
</div>

<footer class="bg-white text-gray-700 relative overflow-hidden">
    {{-- Background Decoration --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div
            class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-[var(--color-primary-light)] to-transparent rounded-full opacity-60 blur-3xl animate-pulse-slow">
        </div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-[var(--color-primary-subtle-hover)] to-transparent rounded-full opacity-60 blur-3xl animate-pulse-slow"
            style="animation-delay: 1s;"></div>
    </div>

    <div class="container mx-auto px-4 py-12 md:py-16 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 stagger-children">

            {{-- Company Info --}}
            <div class="reveal-up" data-aos="fade-up" data-aos-delay="0">
                <h3 class="text-xl font-bold gradient-text uppercase tracking-wide mb-6">
                    {{ optional($contactInfo)->company_name ?? 'Công ty Du lịch King Express' }}
                </h3>
                <div class="space-y-4 text-sm text-gray-600">
                    @if(optional($contactInfo)->branches->isNotEmpty())
                        @php
                            $mainBranch = $contactInfo->branches->firstWhere('is_main', true) ?? $contactInfo->branches->first();
                        @endphp
                        @if($mainBranch)
                            <p class="flex items-start gap-x-3 group">
                                <span
                                    class="flex-shrink-0 w-8 h-8 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center group-hover:bg-[var(--color-primary)] group-hover:text-white transition-all">
                                    <i
                                        class="fa-solid fa-location-dot text-[var(--color-primary)] group-hover:text-white text-sm"></i>
                                </span>
                                <span class="pt-1">{{ $mainBranch->address }}</span>
                            </p>
                        @endif
                    @endif
                    <p class="flex items-center gap-x-3 group">
                        <span
                            class="flex-shrink-0 w-8 h-8 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center group-hover:bg-[var(--color-primary)] group-hover:text-white transition-all">
                            <i class="fa-solid fa-phone text-[var(--color-primary)] group-hover:text-white text-sm"></i>
                        </span>
                        <span><strong>Điện thoại:</strong> {{ optional($contactInfo)->phone ?? '1900 1177' }}</span>
                    </p>
                    <p class="flex items-center gap-x-3 group">
                        <span
                            class="flex-shrink-0 w-8 h-8 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center group-hover:bg-[var(--color-primary)] group-hover:text-white transition-all">
                            <i
                                class="fa-solid fa-envelope text-[var(--color-primary)] group-hover:text-white text-sm"></i>
                        </span>
                        <span>{{ optional($contactInfo)->email ?? 'info@kingexpresstravel.com.vn' }}</span>
                    </p>
                    <p class="flex items-center gap-x-3 group">
                        <span
                            class="flex-shrink-0 w-8 h-8 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center group-hover:bg-[var(--color-primary)] group-hover:text-white transition-all">
                            <i class="fa-solid fa-globe text-[var(--color-primary)] group-hover:text-white text-sm"></i>
                        </span>
                        <span>{{ request()->getHost() }}</span>
                    </p>
                </div>
            </div>

            {{-- Customer Links & Social --}}
            <div class="reveal-up" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-base font-bold text-gray-800 uppercase tracking-wide flex items-center gap-x-2 mb-6">
                    <span
                        class="w-10 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-primary-accent)] rounded-full"></span>
                    Góc khách hàng
                </h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="#"
                            class="group flex items-center text-gray-600 hover:text-[var(--color-primary)] transition-all">
                            <i
                                class="fa-solid fa-chevron-right text-xs mr-2 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[var(--color-primary)]"></i>
                            <span class="group-hover:translate-x-1 transition-transform">Chính sách đặt tour</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-gray-600 hover:text-[var(--color-primary)] transition-all">
                            <i
                                class="fa-solid fa-chevron-right text-xs mr-2 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[var(--color-primary)]"></i>
                            <span class="group-hover:translate-x-1 transition-transform">Chính sách bảo mật</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-gray-600 hover:text-[var(--color-primary)] transition-all">
                            <i
                                class="fa-solid fa-chevron-right text-xs mr-2 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[var(--color-primary)]"></i>
                            <span class="group-hover:translate-x-1 transition-transform">Ý kiến khách hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.contact') }}"
                            class="group flex items-center text-gray-600 hover:text-[var(--color-primary)] transition-all">
                            <i
                                class="fa-solid fa-chevron-right text-xs mr-2 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[var(--color-primary)]"></i>
                            <span class="group-hover:translate-x-1 transition-transform">Phiếu góp ý</span>
                        </a>
                    </li>
                </ul>

                <h3
                    class="text-base font-bold text-gray-800 uppercase mt-8 tracking-wide flex items-center gap-x-2 mb-5">
                    <span
                        class="w-10 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-primary-accent)] rounded-full"></span>
                    Kết nối với chúng tôi
                </h3>
                <div class="flex items-center gap-x-3">
                    <a href="{{ optional($contactInfo)->facebook ?? '#' }}" target="_blank"
                        class="social-icon flex items-center justify-center h-11 w-11 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl text-gray-600 hover:from-blue-500 hover:to-blue-600 hover:text-white shadow-sm hover:shadow-lg hover:shadow-blue-500/30"
                        aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#"
                        class="social-icon flex items-center justify-center h-11 w-11 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl text-gray-600 hover:from-red-500 hover:to-red-600 hover:text-white shadow-sm hover:shadow-lg hover:shadow-red-500/30"
                        aria-label="YouTube">
                        <i class="fa-brands fa-youtube text-lg"></i>
                    </a>
                    <a href="#"
                        class="social-icon flex items-center justify-center h-11 w-11 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl text-gray-600 hover:from-pink-500 hover:via-rose-500 hover:to-purple-500 hover:text-white shadow-sm hover:shadow-lg hover:shadow-pink-500/30"
                        aria-label="Instagram">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="#"
                        class="social-icon flex items-center justify-center h-11 w-11 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl text-gray-600 hover:from-blue-400 hover:to-blue-500 hover:text-white shadow-sm hover:shadow-lg hover:shadow-blue-400/30"
                        aria-label="Zalo">
                        <span class="font-bold text-sm">Zalo</span>
                    </a>
                </div>
            </div>

            {{-- Certifications & Payment --}}
            <div class="reveal-up" data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-base font-bold text-gray-800 uppercase tracking-wide flex items-center gap-x-2 mb-6">
                    <span
                        class="w-10 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-primary-accent)] rounded-full"></span>
                    Chứng nhận
                </h3>
                <div class="flex items-center gap-x-4">
                    <div class="p-2 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <img src="https://www.dmca.com/img/dmca_protected_sml_120l.png" alt="DMCA Protected"
                            class="h-10 opacity-90 hover:opacity-100 transition-opacity" loading="lazy">
                    </div>
                    <div class="p-2 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <img src="https://s3.amazonaws.com/cdn.freshdesk.com/data/helpdesk/attachments/production/42068879378/original/HeXCMKuLyHCzmaKrdo-I8C6l8vAiyQtM4w.png?1624931763"
                            alt="Bộ Công Thương" class="h-12 opacity-90 hover:opacity-100 transition-opacity"
                            loading="lazy">
                    </div>
                </div>

                <h3
                    class="text-base font-bold text-gray-800 uppercase mt-8 tracking-wide flex items-center gap-x-2 mb-5">
                    <span
                        class="w-10 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-primary-accent)] rounded-full"></span>
                    Chấp nhận thanh toán
                </h3>
                <div class="flex flex-wrap items-center gap-3">
                    <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR-1.png" alt="VNPAY"
                            class="h-7" loading="lazy">
                    </div>
                    <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1280px-Visa_Inc._logo.svg.png"
                            alt="Visa" class="h-5" loading="lazy">
                    </div>
                    <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png"
                            alt="Mastercard" class="h-5" loading="lazy">
                    </div>
                </div>
            </div>

            {{-- Newsletter & App --}}
            <div class="reveal-up" data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-base font-bold text-gray-800 uppercase tracking-wide flex items-center gap-x-2 mb-6">
                    <span
                        class="w-10 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-primary-accent)] rounded-full"></span>
                    Nhận tin khuyến mãi
                </h3>
                <p class="text-sm text-gray-600 mb-4">Đăng ký để nhận ưu đãi độc quyền và cập nhật tour mới nhất!</p>
                <form action="#" method="POST">
                    <div class="relative group">
                        <input type="email" placeholder="Email của bạn"
                            class="w-full bg-gray-100 border-2 border-transparent rounded-full py-3.5 pl-5 pr-14 focus:outline-none focus:border-[var(--color-primary)] focus:bg-white transition-all input-animated text-sm">
                        <button type="submit"
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 w-11 h-11 flex items-center justify-center bg-gradient-to-r from-[var(--color-primary-accent)] to-[var(--color-primary)] text-white rounded-full hover:from-[var(--color-primary)] hover:to-[var(--color-primary-dark)] transition-all hover:scale-110 hover:shadow-lg cursor-pointer hover:rotate-12"
                            aria-label="Đăng ký">
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </button>
                    </div>
                </form>

                <h3
                    class="text-base font-bold text-gray-800 uppercase mt-8 tracking-wide flex items-center gap-x-2 mb-5">
                    <span
                        class="w-10 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-primary-accent)] rounded-full"></span>
                    Ứng dụng di động
                </h3>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="#" class="transition-all hover:scale-105 hover:-translate-y-1">
                        <img src="https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/en-us?size=250x83&releaseDate=1276560000"
                            alt="Download on the App Store" class="h-11" loading="lazy">
                    </a>
                    <a href="#" class="transition-all hover:scale-105 hover:-translate-y-1">
                        <img src="https://play.google.com/intl/en_us/badges/static/images/badges/vi_badge_web_generic.png"
                            alt="Get it on Google Play" class="h-14" loading="lazy">
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom Section --}}
        <div class="border-t border-gray-200 mt-12 pt-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="text-sm text-gray-600">
                    <h4 class="font-bold text-gray-700 uppercase text-xs tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-id-card text-[var(--color-primary)]"></i>
                        Giấy phép kinh doanh dịch vụ lữ hành quốc tế
                    </h4>
                    <p class="text-gray-500">
                        Số GP/ No: 79-042/2022/ TCDL - GP LHQT | Do TCDL cấp ngày 30/11/2009 - Cấp thay đổi ngày
                        06/06/2022
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="tel:{{ optional($contactInfo)->phone ?? '1900 1177' }}"
                        class="inline-flex items-center gap-x-2 bg-gradient-to-r from-[var(--color-primary-light)] to-[var(--color-primary-subtle-hover)] text-[var(--color-primary-dark)] px-5 py-2.5 rounded-full font-semibold text-sm hover:from-[var(--color-primary)] hover:to-[var(--color-primary-dark)] hover:text-white transition-all hover:shadow-lg group">
                        <i class="fa-solid fa-headset group-hover:animate-bounce"></i>
                        <span>Hotline: {{ optional($contactInfo)->phone ?? '1900 1177' }}</span>
                    </a>
                </div>
            </div>
            <div
                class="mt-8 pt-6 border-t border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <p class="text-xs text-gray-400">
                    Copyright © {{ date('Y') }} <span
                        class="font-semibold text-gray-500">{{ optional($contactInfo)->company_name ?? 'King Express Travel' }}</span>.
                    All rights reserved.
                </p>
                <p class="text-xs text-gray-400">
                    Ghi rõ nguồn "<span class="text-[var(--color-primary)]">{{ request()->getHost() }}</span>" khi sử
                    dụng thông tin từ website này.
                </p>
            </div>
        </div>
    </div>
</footer>