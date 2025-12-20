{{-- ============================================
HEADER - JoyTravel Modern Design
Features:
- Glassmorphism top bar
- Animated logo with custom font
- Redesigned multi-level dropdown menu
- Enhanced mobile experience
============================================ --}}

<header class="sticky top-0 z-[1000] transition-all duration-500" id="main-header">
    {{-- Top Bar - Compact Info Strip --}}
    <div class="bg-gradient-to-r from-amber-500 via-orange-500 to-amber-500 text-white relative">
        {{-- Animated Background Pattern --}}
        <div class="absolute inset-0 opacity-20 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\" 60\" height=\"60\" viewBox=\"0 0 60
                60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg
                fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36
                34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6
                4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        </div>

        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-10 text-sm">
                {{-- Left: Contact Info --}}
                <div class="flex items-center gap-6">
                    <a href="tel:{{ optional($contactInfo)->phone ?? '1900 1177' }}"
                        class="flex items-center gap-2 hover:text-amber-100 transition-colors group">
                        <span
                            class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-all">
                            <i class="fa-solid fa-phone text-xs animate-pulse"></i>
                        </span>
                        <span
                            class="font-medium hidden sm:inline">{{ optional($contactInfo)->phone ?? '1900 1177' }}</span>
                    </a>
                    <a href="mailto:{{ optional($contactInfo)->email ?? 'info@joytravel.vn' }}"
                        class="hidden md:flex items-center gap-2 hover:text-amber-100 transition-colors">
                        <i class="fa-solid fa-envelope text-xs"></i>
                        <span>{{ optional($contactInfo)->email ?? 'info@joytravel.vn' }}</span>
                    </a>
                </div>

                {{-- Right: Account & Language --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('client.contact') }}"
                        class="hidden sm:flex items-center gap-2 hover:text-amber-100 transition-colors">
                        <i class="fa-solid fa-headset"></i>
                        <span>Hỗ trợ</span>
                    </a>

                    {{-- Account --}}
                    <div class="relative" x-data="{ open: false }">
                        @guest
                            <button @click="open = !open"
                                class="flex items-center gap-2 hover:text-amber-100 transition-colors">
                                <i class="fa-regular fa-user"></i>
                                <span class="hidden sm:inline">Tài khoản</span>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform"
                                    :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute right-0 top-full mt-2 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-[1001]">
                                <div class="p-5 text-center bg-gradient-to-br from-amber-50 to-orange-50">
                                    <div
                                        class="w-16 h-16 mx-auto mb-3 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-2xl text-white"></i>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Đăng nhập để trải nghiệm tốt hơn</p>
                                    <button type="button" data-modal-target="login-modal"
                                        class="w-full py-3 px-6 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-full hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <i class="fa-solid fa-sign-in-alt mr-2"></i>Đăng nhập
                                    </button>
                                </div>
                                <div class="p-4 text-center border-t">
                                    <p class="text-sm text-gray-500">
                                        Chưa có tài khoản?
                                        <button type="button" data-modal-switch="register-modal"
                                            class="text-amber-600 font-bold hover:underline">
                                            Đăng ký ngay
                                        </button>
                                    </p>
                                </div>
                            </div>
                        @endguest

                        @auth
                            <button @click="open = !open"
                                class="flex items-center gap-2 hover:text-amber-100 transition-colors">
                                @if(Auth::user()->avatar)
                                    <img class="w-7 h-7 rounded-full object-cover ring-2 ring-white/50"
                                        src="{{ Auth::user()->avatar }}" alt="">
                                @else
                                    <div
                                        class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                                <span class="hidden sm:inline max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 top-full mt-2 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-[1001]">
                                <div class="p-4 bg-gradient-to-br from-amber-50 to-orange-50 border-b">
                                    <p class="font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="py-2">
                                    <a href="{{ route('client.profile') }}"
                                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-amber-50 transition-colors">
                                        <i class="fa-regular fa-user w-5 text-amber-500"></i>
                                        <span>Trang cá nhân</span>
                                    </a>
                                    <a href="{{ route('client.profile.history') }}"
                                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-amber-50 transition-colors">
                                        <i class="fa-solid fa-clock-rotate-left w-5 text-amber-500"></i>
                                        <span>Lịch sử đặt tour</span>
                                    </a>
                                </div>
                                <div class="border-t">
                                    <form method="POST" action="{{ route('client.logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 transition-colors">
                                            <i class="fa-solid fa-right-from-bracket w-5"></i>
                                            <span>Đăng xuất</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Navigation --}}
    <nav class="bg-white/95 backdrop-blur-md shadow-lg transition-all duration-300" id="main-nav">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                {{-- Logo --}}
                <a href="{{ route('client.home') }}" class="flex items-center gap-3 group">
                    {{-- Logo Icon --}}
                    <div class="relative">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 via-orange-500 to-red-500 flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all group-hover:scale-105 rotate-3 group-hover:rotate-0">
                            <i class="fa-solid fa-earth-asia text-white text-xl"></i>
                        </div>
                        <div
                            class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-400 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fa-solid fa-check text-white text-[8px]"></i>
                        </div>
                    </div>
                    {{-- Logo Text --}}
                    <div class="flex flex-col">
                        <span class="text-2xl sm:text-3xl font-black tracking-tight">
                            <span
                                class="bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 bg-clip-text text-transparent">KingExpress</span><span
                                class="text-gray-800">Travel</span>
                        </span>
                        <span class="text-[10px] text-gray-400 font-medium tracking-[0.2em] uppercase mt-0.5">Khám phá
                            niềm vui</span>
                    </div>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center gap-1">
                    {{-- Home --}}
                    <a href="{{ route('client.home') }}"
                        class="relative px-5 py-2 font-semibold text-gray-700 hover:text-amber-600 transition-colors group {{ request()->routeIs('client.home') ? 'text-amber-600' : '' }}">
                        Trang chủ
                        <span
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-amber-500 to-orange-500 transition-all group-hover:w-full {{ request()->routeIs('client.home') ? 'w-full' : '' }}"></span>
                    </a>

                    {{-- Tours Dropdown --}}
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true"
                        @mouseleave="open = false">
                        <a href="{{ route('client.tours') }}"
                            class="relative px-5 py-2 font-semibold text-gray-700 hover:text-amber-600 transition-colors flex items-center gap-1 {{ request()->routeIs('client.tours*') ? 'text-amber-600' : '' }}">
                            Du lịch
                            <i class="fa-solid fa-chevron-down text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i>
                            <span
                                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-amber-500 to-orange-500 transition-all group-hover:w-full {{ request()->routeIs('client.tours*') ? 'w-full' : '' }}"></span>
                        </a>

                        {{-- Mega Menu --}}
                        @if(isset($tourCategoriesForMenu) && $tourCategoriesForMenu->isNotEmpty())
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-2"
                                class="absolute top-full left-1/2 -translate-x-1/2 pt-4 w-[900px] z-[1001]">
                                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                                    {{-- Menu Header --}}
                                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-4">
                                        <h3 class="text-white font-bold text-lg flex items-center gap-2">
                                            <i class="fa-solid fa-compass"></i>
                                            Khám phá các tour du lịch
                                        </h3>
                                    </div>

                                    {{-- Menu Content --}}
                                    <div class="p-8">
                                        <div class="grid grid-cols-3 gap-8">
                                            @foreach($tourCategoriesForMenu->take(6) as $category)
                                                <div class="group/cat">
                                                    <a href="{{ route('client.tours', ['category' => $category->slug]) }}"
                                                        class="flex items-center gap-3 p-3 rounded-xl hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 transition-all">
                                                        <div
                                                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 flex items-center justify-center group-hover/cat:from-amber-200 group-hover/cat:to-orange-200 transition-colors">
                                                            <i class="fa-solid fa-map-location-dot text-amber-600"></i>
                                                        </div>
                                                        <div class="flex-1">
                                                            <span
                                                                class="font-bold text-gray-800 group-hover/cat:text-amber-600 transition-colors block">{{ $category->name }}</span>
                                                            @if($category->children->isNotEmpty())
                                                                <span
                                                                    class="text-xs text-gray-400">{{ $category->children->count() }}
                                                                    danh mục con</span>
                                                            @endif
                                                        </div>
                                                        <i
                                                            class="fa-solid fa-chevron-right text-xs text-gray-300 group-hover/cat:text-amber-500 transition-colors"></i>
                                                    </a>

                                                    {{-- Sub Categories --}}
                                                    @if($category->children->isNotEmpty())
                                                        <div class="ml-12 mt-1 space-y-1">
                                                            @foreach($category->children->take(3) as $child)
                                                                <a href="{{ route('client.tours', ['category' => $child->slug]) }}"
                                                                    class="block text-sm text-gray-500 hover:text-amber-600 py-1 transition-colors">
                                                                    {{ $child->name }}
                                                                </a>
                                                            @endforeach
                                                            @if($category->children->count() > 3)
                                                                <a href="{{ route('client.tours', ['category' => $category->slug]) }}"
                                                                    class="block text-sm text-amber-600 font-medium py-1">
                                                                    + {{ $category->children->count() - 3 }} danh mục khác
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- View All Button --}}
                                        <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                                            <a href="{{ route('client.tours') }}"
                                                class="inline-flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold rounded-full hover:from-amber-600 hover:to-orange-600 transition-all shadow-md hover:shadow-lg">
                                                Xem tất cả tour
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- News --}}
                    <a href="{{ route('client.news') }}"
                        class="relative px-5 py-2 font-semibold text-gray-700 hover:text-amber-600 transition-colors group {{ request()->routeIs('client.news*') ? 'text-amber-600' : '' }}">
                        Tin tức
                        <span
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-amber-500 to-orange-500 transition-all group-hover:w-full {{ request()->routeIs('client.news*') ? 'w-full' : '' }}"></span>
                    </a>

                    {{-- About --}}
                    <a href="{{ route('client.about') }}"
                        class="relative px-5 py-2 font-semibold text-gray-700 hover:text-amber-600 transition-colors group {{ request()->routeIs('client.about') ? 'text-amber-600' : '' }}">
                        Giới thiệu
                        <span
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-amber-500 to-orange-500 transition-all group-hover:w-full {{ request()->routeIs('client.about') ? 'w-full' : '' }}"></span>
                    </a>

                    {{-- Contact --}}
                    <a href="{{ route('client.contact') }}"
                        class="relative px-5 py-2 font-semibold text-gray-700 hover:text-amber-600 transition-colors group {{ request()->routeIs('client.contact') ? 'text-amber-600' : '' }}">
                        Liên hệ
                        <span
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-amber-500 to-orange-500 transition-all group-hover:w-full {{ request()->routeIs('client.contact') ? 'w-full' : '' }}"></span>
                    </a>
                </div>

                {{-- Right Side: Search & CTA --}}
                <div class="hidden lg:flex items-center gap-4">
                    {{-- Search Button --}}
                    <button type="button" id="search-toggle"
                        class="w-10 h-10 rounded-full bg-gray-100 hover:bg-amber-100 flex items-center justify-center text-gray-600 hover:text-amber-600 transition-all">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    {{-- CTA Button --}}
                    <a href="{{ route('client.tours') }}"
                        class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-full hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        Đặt tour ngay
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-button"
                    class="lg:hidden w-10 h-10 rounded-xl bg-gray-100 hover:bg-amber-100 flex items-center justify-center transition-colors">
                    <div class="hamburger" id="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
            </div>
        </div>

        {{-- Search Bar (Hidden by default) --}}
        <div id="search-panel" class="hidden border-t border-gray-100 bg-gray-50">
            <div class="container mx-auto px-4 py-4">
                <form action="{{ route('client.tours') }}" method="GET" class="relative max-w-2xl mx-auto">
                    <input type="search" name="search" placeholder="Tìm kiếm tour, điểm đến, trải nghiệm..."
                        class="w-full pl-12 pr-24 py-4 rounded-2xl border-2 border-gray-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all text-lg"
                        id="main-search-input">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                    <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all">
                        Tìm kiếm
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>

{{-- Mobile Menu Panel --}}
<div id="mobile-menu" class="mobile-menu-panel lg:hidden z-[1002]">
    <div class="h-full flex flex-col bg-white">
        {{-- Header --}}
        <div class="flex items-center justify-between p-4 border-b bg-gradient-to-r from-amber-50 to-orange-50">
            <div class="flex items-center gap-2">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                    <i class="fa-solid fa-plane text-white transform -rotate-45"></i>
                </div>
                <span class="text-xl font-black">
                    <span class="text-amber-500">joy</span><span class="text-gray-800">travel</span>
                </span>
            </div>
            <button id="mobile-menu-close"
                class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark text-xl text-gray-600"></i>
            </button>
        </div>

        {{-- Search --}}
        <div class="p-4 border-b">
            <form action="{{ route('client.tours') }}" method="GET">
                <div class="relative">
                    <input type="search" name="search" placeholder="Tìm tour du lịch..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-100 focus:bg-white focus:ring-2 focus:ring-amber-500 transition-all">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </form>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto p-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('client.home') }}"
                        class="flex items-center gap-4 p-3 rounded-xl transition-all {{ request()->routeIs('client.home') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white' : 'hover:bg-gray-100' }}">
                        <div
                            class="w-10 h-10 rounded-xl {{ request()->routeIs('client.home') ? 'bg-white/20' : 'bg-amber-100' }} flex items-center justify-center">
                            <i
                                class="fa-solid fa-home {{ request()->routeIs('client.home') ? 'text-white' : 'text-amber-600' }}"></i>
                        </div>
                        <span class="font-semibold">Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.tours') }}"
                        class="flex items-center gap-4 p-3 rounded-xl transition-all {{ request()->routeIs('client.tours*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white' : 'hover:bg-gray-100' }}">
                        <div
                            class="w-10 h-10 rounded-xl {{ request()->routeIs('client.tours*') ? 'bg-white/20' : 'bg-amber-100' }} flex items-center justify-center">
                            <i
                                class="fa-solid fa-plane {{ request()->routeIs('client.tours*') ? 'text-white' : 'text-amber-600' }}"></i>
                        </div>
                        <span class="font-semibold">Du lịch</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.news') }}"
                        class="flex items-center gap-4 p-3 rounded-xl transition-all {{ request()->routeIs('client.news*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white' : 'hover:bg-gray-100' }}">
                        <div
                            class="w-10 h-10 rounded-xl {{ request()->routeIs('client.news*') ? 'bg-white/20' : 'bg-amber-100' }} flex items-center justify-center">
                            <i
                                class="fa-solid fa-newspaper {{ request()->routeIs('client.news*') ? 'text-white' : 'text-amber-600' }}"></i>
                        </div>
                        <span class="font-semibold">Tin tức</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.about') }}"
                        class="flex items-center gap-4 p-3 rounded-xl transition-all {{ request()->routeIs('client.about') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white' : 'hover:bg-gray-100' }}">
                        <div
                            class="w-10 h-10 rounded-xl {{ request()->routeIs('client.about') ? 'bg-white/20' : 'bg-amber-100' }} flex items-center justify-center">
                            <i
                                class="fa-solid fa-info-circle {{ request()->routeIs('client.about') ? 'text-white' : 'text-amber-600' }}"></i>
                        </div>
                        <span class="font-semibold">Giới thiệu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.contact') }}"
                        class="flex items-center gap-4 p-3 rounded-xl transition-all {{ request()->routeIs('client.contact') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white' : 'hover:bg-gray-100' }}">
                        <div
                            class="w-10 h-10 rounded-xl {{ request()->routeIs('client.contact') ? 'bg-white/20' : 'bg-amber-100' }} flex items-center justify-center">
                            <i
                                class="fa-solid fa-envelope {{ request()->routeIs('client.contact') ? 'text-white' : 'text-amber-600' }}"></i>
                        </div>
                        <span class="font-semibold">Liên hệ</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Auth Section --}}
        <div class="p-4 border-t bg-gray-50">
            @guest
                <button type="button" data-modal-target="login-modal"
                    class="w-full py-3 px-6 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg flex items-center justify-center gap-2">
                    <i class="fa-solid fa-sign-in-alt"></i>
                    Đăng nhập
                </button>
                <p class="text-center text-sm text-gray-500 mt-3">
                    Chưa có tài khoản?
                    <button type="button" data-modal-switch="register-modal"
                        class="text-amber-600 font-bold hover:underline">
                        Đăng ký
                    </button>
                </p>
            @endguest

            @auth
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl mb-3">
                    @if(Auth::user()->avatar)
                        <img class="w-12 h-12 rounded-xl object-cover" src="{{ Auth::user()->avatar }}" alt="">
                    @else
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('client.profile') }}"
                        class="flex items-center justify-center gap-2 py-2 px-3 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors text-sm font-medium">
                        <i class="fa-regular fa-user text-amber-600"></i>
                        Trang cá nhân
                    </a>
                    <form method="POST" action="{{ route('client.logout') }}" class="contents">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center gap-2 py-2 px-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition-colors text-sm font-medium">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Đăng xuất
                        </button>
                    </form>
                </div>
            @endauth
        </div>

        {{-- Hotline --}}
        <a href="tel:{{ optional($contactInfo)->phone ?? '1900 1177' }}"
            class="m-4 p-4 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl flex items-center gap-4 text-white">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                <i class="fa-solid fa-phone text-xl animate-pulse"></i>
            </div>
            <div>
                <p class="text-sm opacity-90">Hotline hỗ trợ 24/7</p>
                <p class="text-xl font-bold">{{ optional($contactInfo)->phone ?? '1900 1177' }}</p>
            </div>
        </a>
    </div>
</div>

{{-- Search Toggle Script --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchToggle = document.getElementById('search-toggle');
            const searchPanel = document.getElementById('search-panel');
            const searchInput = document.getElementById('main-search-input');

            if (searchToggle && searchPanel) {
                searchToggle.addEventListener('click', function () {
                    searchPanel.classList.toggle('hidden');
                    if (!searchPanel.classList.contains('hidden') && searchInput) {
                        setTimeout(() => searchInput.focus(), 100);
                    }
                });
            }
        });
    </script>
@endpush