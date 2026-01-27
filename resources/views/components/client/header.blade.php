@props(['contactInfo', 'tourCategoriesForMenu'])

<div x-data="{
    mobileMenuOpen: false,
    searchOpen: false,
    scrolled: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 20;
        });
    }
}" class="relative z-[1000]">
    {{-- Header Content --}}
    <header :class="{ 'shadow-lg': scrolled }"
        class="fixed top-0 w-full transition-all duration-300 bg-white/95 backdrop-blur-md border-b border-gray-100/50">
        {{-- Top Bar --}}
        <div class="bg-gradient-to-r from-amber-500 via-orange-500 to-amber-500 text-white relative">
            <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="2"
                                fill="none" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid-pattern)" />
                </svg>
            </div>
            <div class="container mx-auto px-4 h-10 flex items-center justify-between text-sm relative z-10">
                <div class="flex items-center gap-6">
                    <a href="tel:{{ optional($contactInfo)->phone ?? '1900 1177' }}"
                        class="flex items-center gap-2 hover:text-amber-100 transition-colors min-h-[44px] outline-none focus:outline-none">
                        <i class="fa-solid fa-phone text-xs animate-bounce" aria-hidden="true"></i>
                        <span class="font-medium">{{ optional($contactInfo)->phone ?? '1900 1177' }}</span>
                    </a>
                    <a href="mailto:{{ optional($contactInfo)->email ?? 'info@kingexpresstravel.com.vn' }}"
                        class="hidden md:flex items-center gap-2 hover:text-amber-100 transition-colors min-h-[44px] outline-none focus:outline-none">
                        <i class="fa-solid fa-envelope text-xs" aria-hidden="true"></i>
                        <span>{{ optional($contactInfo)->email ?? 'info@kingexpresstravel.com.vn' }}</span>
                    </a>
                </div>
                {{-- Auth Links --}}
                <div class="flex items-center gap-2">
                    @guest
                        <a href="{{ route('client.login') }}"
                            class="px-3 py-1.5 text-sm font-medium rounded-full hover:bg-white/15 active:bg-white/25 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/40"
                            aria-label="Đăng nhập">
                            <i class="fa-solid fa-right-to-bracket mr-1.5" aria-hidden="true"></i>
                            Đăng nhập
                        </a>
                        <span class="opacity-40 text-xs">|</span>
                        <a href="{{ route('client.register') }}"
                            class="px-3 py-1.5 text-sm font-medium rounded-full bg-white/15 hover:bg-white/25 active:bg-white/30 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/40"
                            aria-label="Đăng ký">
                            <i class="fa-solid fa-user-plus mr-1.5" aria-hidden="true"></i>
                            Đăng ký
                        </a>
                    @endguest
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-2 hover:text-amber-100 transition-colors">
                                <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                    alt="Avatar" class="w-6 h-6 rounded-full border border-white/50">
                                <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-[10px]" :class="{ 'rotate-180': open }"></i>
                            </button>
                            {{-- Dropdown Menu (Giữ nguyên logic cũ) --}}
                            <div x-show="open" style="display: none;"
                                class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 text-gray-800 z-50">
                                <div class="px-4 py-2 border-b border-gray-50 bg-gray-50/50">
                                    <p class="font-bold text-sm truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('client.profile') }}"
                                    class="block px-4 py-2 hover:bg-amber-50 text-gray-700">Trang cá nhân</a>
                                <a href="{{ route('client.profile.history') }}"
                                    class="block px-4 py-2 hover:bg-amber-50 text-gray-700">Lịch sử đặt tour</a>
                                <form method="POST" action="{{ route('client.logout') }}"
                                    class="border-t border-gray-50 mt-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-50">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Main Navigation --}}
        <div class="container mx-auto px-4 h-20 flex items-center justify-between">
            <a href="{{ route('client.home') }}" class="flex items-center gap-3 outline-none focus:outline-none">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg text-white text-2xl">
                    <i class="fa-solid fa-earth-asia"></i>
                </div>
                <div class="flex flex-col leading-tight">
                    <span
                        class="text-2xl font-extrabold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">KingExpress</span>
                    <span class="text-xs tracking-widest text-gray-400 font-medium uppercase">Explore the world</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <nav class="hidden lg:flex items-center gap-8 h-full">
                <a href="{{ route('client.home') }}"
                    class="h-full flex items-center font-bold text-gray-700 hover:text-amber-600 transition-colors relative group {{ request()->routeIs('client.home') ? 'text-amber-600' : '' }}">
                    Trang chủ
                    <span
                        class="absolute bottom-5 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 ease-out group-hover:w-full {{ request()->routeIs('client.home') ? 'w-full' : '' }}"></span>
                </a>

                {{-- Mega Menu Logic --}}
                <div class="relative group h-full flex items-center" x-data="{ open: false }">
                    <a href="{{ route('client.tours') }}" @mouseenter="open = true" @mouseleave="open = false"
                        class="h-full flex items-center font-bold text-gray-700 hover:text-amber-600 transition-colors gap-1 {{ request()->routeIs('client.tours*') ? 'text-amber-600' : '' }}">
                        Du lịch <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
                            :class="{ 'rotate-180': open }"></i>
                        <span
                            class="absolute bottom-5 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 ease-out group-hover:w-full {{ request()->routeIs('client.tours*') ? 'w-full' : '' }}"></span>
                    </a>

                    {{-- Mega Menu Dropdown Content --}}
                    <div x-show="open" @mouseenter="open = true" @mouseleave="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute top-14 left-1/2 -translate-x-1/2 w-[900px] pt-4 z-50" style="display: none;">

                        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden"
                            x-data="{ activeCategory: 0 }">
                            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-3">
                                <h3 class="text-white font-bold flex items-center gap-2">
                                    <i class="fa-solid fa-compass"></i> Khám phá các tour du lịch
                                </h3>
                            </div>
                            <div class="grid grid-cols-12 min-h-[380px]">
                                {{-- Sidebar Categories --}}
                                <div class="col-span-4 border-r border-gray-100 py-2 bg-gray-50/50">
                                    @if (isset($tourCategoriesForMenu) && $tourCategoriesForMenu->isNotEmpty())
                                        @foreach ($tourCategoriesForMenu->take(8) as $index => $category)
                                            <button @mouseenter="activeCategory = {{ $index }}"
                                                @click="window.location.href='{{ route('client.tours', ['category' => $category->slug]) }}'"
                                                class="w-full text-left px-5 py-3 transition-all outline-none"
                                                :class="activeCategory === {{ $index }} ?
                                                    'bg-white text-amber-600 shadow-sm border-r-2 border-amber-500' :
                                                    'hover:bg-white text-gray-700'">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                                                        :class="activeCategory === {{ $index }} ? 'bg-amber-100' :
                                                            'bg-gray-100'">
                                                        <i class="fa-solid fa-map-location-dot text-sm"
                                                            :class="activeCategory === {{ $index }} ? 'text-amber-600' :
                                                                'text-gray-500'"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <span
                                                            class="font-semibold block truncate">{{ $category->name }}</span>
                                                        @if ($category->tours->count() > 0)
                                                            <span
                                                                class="text-xs text-gray-400">{{ $category->tours->count() }}
                                                                tour</span>
                                                        @endif
                                                    </div>
                                                    <i class="fa-solid fa-chevron-right text-xs text-gray-300"></i>
                                                </div>
                                            </button>
                                        @endforeach
                                    @endif
                                </div>

                                {{-- Featured Tours Panel --}}
                                <div class="col-span-8 p-5">
                                    @if (isset($tourCategoriesForMenu) && $tourCategoriesForMenu->isNotEmpty())
                                        @foreach ($tourCategoriesForMenu->take(8) as $index => $category)
                                            <div x-show="activeCategory === {{ $index }}" x-transition.opacity>
                                                <div class="flex items-center justify-between mb-4">
                                                    <h4 class="font-bold text-lg text-gray-800">Tours
                                                        {{ $category->name }}</h4>
                                                    <a href="{{ route('client.tours', ['category' => $category->slug]) }}"
                                                        class="text-sm text-amber-600 hover:underline font-medium">Xem
                                                        tất cả →</a>
                                                </div>
                                                @if ($category->tours->isNotEmpty())
                                                    <div class="grid grid-cols-2 gap-3">
                                                        @foreach ($category->tours->take(4) as $tour)
                                                            <a href="{{ route('client.tour.show', $tour->slug) }}"
                                                                class="flex gap-3 p-3 rounded-xl hover:bg-amber-50 transition-colors group">
                                                                <img src="{{ $tour->thumbnail ?: 'https://placehold.co/80x80?text=Tour' }}"
                                                                    alt=""
                                                                    class="w-16 h-16 rounded-lg object-cover flex-shrink-0 group-hover:scale-105 transition-transform">
                                                                <div class="flex-1 min-w-0">
                                                                    <p
                                                                        class="font-semibold text-gray-800 text-sm line-clamp-2 group-hover:text-amber-600 transition-colors">
                                                                        {{ $tour->name }}</p>
                                                                    <p class="text-xs text-gray-500 mt-1"><i
                                                                            class="fa-regular fa-clock mr-1"></i>
                                                                        {{ $tour->duration ?: 'N/A' }}</p>
                                                                    <p class="text-amber-600 font-bold text-sm mt-1">
                                                                        {{ number_format($tour->price_adult) }}đ</p>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="text-center py-8 text-gray-400">
                                                        <i class="fa-solid fa-plane text-4xl mb-2"></i>
                                                        <p>Chưa có tour trong danh mục này</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div
                                class="border-t border-gray-100 p-4 text-center bg-gradient-to-r from-amber-50 to-orange-50">
                                <a href="{{ route('client.tours') }}"
                                    class="inline-flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-full hover:from-amber-600 hover:to-orange-600 transition-all shadow-md hover:shadow-lg">
                                    Xem tất cả tour <i class="fa-solid fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('client.news') }}"
                    class="h-full flex items-center font-bold text-gray-700 hover:text-amber-600 transition-colors relative group {{ request()->routeIs('client.news*') ? 'text-amber-600' : '' }}">
                    Tin tức
                    <span
                        class="absolute bottom-5 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 ease-out group-hover:w-full {{ request()->routeIs('client.news*') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ route('client.about') }}"
                    class="h-full flex items-center font-bold text-gray-700 hover:text-amber-600 transition-colors relative group {{ request()->routeIs('client.about') ? 'text-amber-600' : '' }}">
                    Giới thiệu
                    <span
                        class="absolute bottom-5 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 ease-out group-hover:w-full {{ request()->routeIs('client.about') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ route('client.contact') }}"
                    class="h-full flex items-center font-bold text-gray-700 hover:text-amber-600 transition-colors relative group {{ request()->routeIs('client.contact') ? 'text-amber-600' : '' }}">
                    Liên hệ
                    <span
                        class="absolute bottom-5 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 ease-out group-hover:w-full {{ request()->routeIs('client.contact') ? 'w-full' : '' }}"></span>
                </a>
            </nav>

            {{-- Right Actions --}}
            <div class="hidden lg:flex items-center gap-3">
                <button @click="searchOpen = !searchOpen"
                    class="w-11 h-11 rounded-full bg-gray-100/80 flex items-center justify-center text-gray-600 hover:bg-amber-100 hover:text-amber-600 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2"
                    aria-label="Mở tìm kiếm" :aria-expanded="searchOpen">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                </button>
                <a href="{{ route('client.tours') }}"
                    class="group relative px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-full shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] transition-all duration-200 overflow-hidden focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fa-solid fa-plane-departure text-sm" aria-hidden="true"></i>
                        Đặt Tour Ngay
                    </span>
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-amber-600 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                </a>
            </div>

            {{-- Mobile Menu Toggle --}}
            <button @click="mobileMenuOpen = true"
                class="lg:hidden w-11 h-11 flex items-center justify-center text-amber-600 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/50 rounded-xl shadow-sm hover:shadow-md hover:border-amber-300/50 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-400"
                aria-label="Mở menu điều hướng" aria-expanded="false" :aria-expanded="mobileMenuOpen">
                <i class="fa-solid fa-bars text-lg" aria-hidden="true"></i>
            </button>
        </div>

        {{-- Mobile Search (Expandable) --}}
        <div x-show="searchOpen" x-collapse style="display: none;"
            class="bg-white border-t border-gray-100 shadow-inner">
            <div class="container mx-auto px-4 py-4">
                <form action="{{ route('client.tours') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Tìm kiếm địa điểm, tour du lịch..."
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 outline-none transition-all">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <button type="submit"
                        class="absolute right-2 top-2 bottom-2 px-4 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors font-medium">Tìm</button>
                </form>
            </div>
        </div>
    </header>

    {{-- Spacer --}}
    <div class="h-[104px]"></div>

    {{-- Mobile Menu (Giữ nguyên logic cũ, chỉ dùng $contactInfo nếu cần) --}}
    <div x-show="mobileMenuOpen" x-transition.opacity @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/50 z-[1001] backdrop-blur-sm lg:hidden" style="display: none;"></div>
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-full w-[85%] max-w-sm bg-white shadow-2xl z-[1002] flex flex-col lg:hidden"
        style="display: none;">
        <div class="p-5 flex items-center justify-between border-b border-gray-100">
            <h3 class="font-extrabold text-xl text-gray-800">Menu</h3>
            <button @click="mobileMenuOpen = false"
                class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-red-50 hover:text-red-500 transition-all">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-5 space-y-4">
            <a href="{{ route('client.home') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-amber-50 text-gray-700 font-bold {{ request()->routeIs('client.home') ? 'bg-amber-50 text-amber-600' : '' }}">
                <i class="fa-solid fa-home w-6 text-center text-amber-500"></i> Trang chủ
            </a>
            <a href="{{ route('client.tours') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-amber-50 text-gray-700 font-bold {{ request()->routeIs('client.tours*') ? 'bg-amber-50 text-amber-600' : '' }}">
                <i class="fa-solid fa-plane w-6 text-center text-amber-500"></i> Du lịch
            </a>
            <a href="{{ route('client.news') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-amber-50 text-gray-700 font-bold {{ request()->routeIs('client.news*') ? 'bg-amber-50 text-amber-600' : '' }}">
                <i class="fa-solid fa-newspaper w-6 text-center text-amber-500"></i> Tin tức
            </a>
            <a href="{{ route('client.about') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-amber-50 text-gray-700 font-bold {{ request()->routeIs('client.about') ? 'bg-amber-50 text-amber-600' : '' }}">
                <i class="fa-solid fa-info-circle w-6 text-center text-amber-500"></i> Giới thiệu
            </a>
            <a href="{{ route('client.contact') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-amber-50 text-gray-700 font-bold {{ request()->routeIs('client.contact') ? 'bg-amber-50 text-amber-600' : '' }}">
                <i class="fa-solid fa-envelope w-6 text-center text-amber-500"></i> Liên hệ
            </a>
            <div class="border-t border-gray-100 my-4 pt-4">
                @guest
                    <a href="{{ route('client.login') }}"
                        class="w-full py-3 rounded-xl bg-amber-500 text-white font-bold mb-3 shadow-lg shadow-amber-500/30 block text-center">Đăng
                        nhập</a>
                    <a href="{{ route('client.register') }}"
                        class="w-full py-3 rounded-xl border border-amber-500 text-amber-600 font-bold hover:bg-amber-50 block text-center">Đăng
                        ký</a>
                @endguest
                @auth
                    <form method="POST" action="{{ route('client.logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-2 bg-red-50 text-red-500 rounded-lg font-bold">Đăng
                            xuất</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>
