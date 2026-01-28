@extends('client.layouts.app')

@section('title', $selectedCategory->name ?? 'Danh sách Tour du lịch')
@section('description',
    'Khám phá các tour du lịch hấp dẫn trong và ngoài nước được tổ chức bởi King Express Travel. Đa
    dạng lựa chọn, giá cả cạnh tranh.')

@php
    use App\Services\Client\SearchService;
    $pricePresets = $pricePresets ?? SearchService::PRICE_PRESETS;
@endphp

@section('content')
    <div x-data="tourFilter()" class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
        {{-- Hero Header --}}
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 py-10 md:py-16">
            <div class="container mx-auto px-4">
                <div class="text-center text-white">
                    <h1 class="text-3xl md:text-5xl font-extrabold mb-3 drop-shadow-lg">
                        {{ $selectedCategory->name ?? 'Tour Du Lịch' }}
                    </h1>
                    <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto">
                        Khám phá thế giới qua những hành trình đầy cảm hứng từ King Express Travel
                    </p>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 -mt-6 relative z-10">
            {{-- Quick Search Bar for Results Page --}}
            <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 mb-8 border border-gray-100">
                <form action="{{ route('client.tours') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                            placeholder="Tìm kiếm tour theo tên..."
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                    </div>
                    <div class="w-full md:w-48">
                        <select name="destination"
                            class="w-full py-3.5 px-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent bg-gray-50 focus:bg-white">
                            <option value="">Tất cả điểm đến</option>
                            @foreach ($destinations as $dest)
                                <option value="{{ $dest->slug }}" @selected(($filters['destination'] ?? '') == $dest->slug)>
                                    {{ $dest->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="bg-[var(--color-primary)] text-white font-bold py-3.5 px-8 rounded-xl hover:bg-[var(--color-primary-dark)] transition-all shadow-lg shadow-amber-500/20 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-search"></i>
                        <span class="hidden md:inline">Tìm kiếm</span>
                    </button>
                </form>
            </div>

            {{-- Active Filters Display --}}
            @if (count($activeFilters ?? []) > 0)
                <div class="mb-6 flex flex-wrap items-center gap-2">
                    <span class="text-sm text-gray-500 font-medium">Đang lọc:</span>
                    @foreach ($activeFilters as $filter)
                        <span
                            class="inline-flex items-center gap-2 bg-amber-100 text-amber-800 px-3 py-1.5 rounded-full text-sm font-medium">
                            {{ $filter['label'] }}
                            <a href="{{ request()->fullUrlWithQuery([$filter['param'] => null, 'price_from' => null, 'price_to' => null]) }}"
                                class="hover:text-amber-600 transition-colors" title="Xóa bộ lọc này">
                                <i class="fa-solid fa-times text-xs"></i>
                            </a>
                        </span>
                    @endforeach
                    <a href="{{ route('client.tours') }}"
                        class="text-sm text-gray-500 hover:text-[var(--color-primary)] transition-colors ml-2">
                        <i class="fa-solid fa-eraser mr-1"></i> Xóa tất cả
                    </a>
                </div>
            @endif

            {{-- Mobile Filter Toggle Bar --}}
            <div
                class="lg:hidden sticky top-[56px] z-40 bg-white/95 backdrop-blur-md border-b p-4 flex justify-between items-center shadow-sm -mx-4 mb-6">
                <span class="font-semibold text-gray-800 flex items-center gap-2">
                    <span class="bg-[var(--color-primary)] text-white text-xs font-bold px-2 py-1 rounded-full">
                        {{ $tours->total() }}
                    </span>
                    tour được tìm thấy
                </span>
                <button @click="filterOpen = true"
                    class="flex items-center gap-2 bg-[var(--color-primary)] text-white px-4 py-2.5 rounded-xl font-medium hover:bg-[var(--color-primary-dark)] transition-all shadow-md"
                    aria-label="Mở bộ lọc">
                    <i class="fa-solid fa-sliders"></i>
                    Bộ lọc
                </button>
            </div>

            {{-- Mobile Filter Drawer Overlay --}}
            <div x-show="filterOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="filterOpen = false"
                class="fixed inset-0 bg-black/50 z-50 lg:hidden backdrop-blur-sm" style="display: none;"></div>

            {{-- Mobile Filter Drawer Panel --}}
            <div x-show="filterOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full" x-trap.noscroll="filterOpen"
                @keydown.escape.window="filterOpen = false"
                class="fixed inset-y-0 right-0 w-full max-w-sm bg-white z-50 lg:hidden overflow-y-auto shadow-2xl"
                style="display: none;">

                <div class="sticky top-0 bg-white border-b p-4 flex justify-between items-center z-10">
                    <h2 class="font-bold text-lg flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-[var(--color-primary)]"></i>
                        Bộ lọc tìm kiếm
                    </h2>
                    <button @click="filterOpen = false"
                        class="p-2 hover:bg-gray-100 rounded-full transition-colors" aria-label="Đóng bộ lọc">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <div class="p-4 pb-32">
                    @include('client.tours.partials._filter_form', ['isMobile' => true])
                </div>

                <div class="fixed bottom-0 left-0 right-0 bg-white border-t p-4 flex gap-3 max-w-sm ml-auto shadow-2xl">
                    <a href="{{ route('client.tours') }}"
                        class="flex-1 py-3 border border-gray-300 rounded-xl font-medium text-center hover:bg-gray-50 transition-colors">
                        Xóa bộ lọc
                    </a>
                    <button type="submit" form="mobile-filter-form"
                        class="flex-1 py-3 bg-[var(--color-primary)] text-white rounded-xl font-bold hover:bg-[var(--color-primary-dark)] transition-colors shadow-lg">
                        Áp dụng
                    </button>
                </div>
            </div>

            {{-- Quick Filter Pills --}}
            <div class="overflow-x-auto pb-2 mb-6 -mx-4 px-4 lg:mx-0 lg:px-0 scrollbar-hide">
                <div class="flex gap-2 whitespace-nowrap">
                    {{-- Price Quick Filters --}}
                    @foreach ($pricePresets as $key => $preset)
                        @if ($key !== 'all')
                            @php
                                $isActive = ($filters['price_preset'] ?? '') === $key;
                            @endphp
                            <a href="{{ route('client.tours', array_merge(request()->except(['price_preset', 'price_from', 'price_to', 'page']), $isActive ? [] : ['price_preset' => $key])) }}"
                                class="px-4 py-2.5 rounded-full border text-sm font-medium transition-all flex items-center gap-2
                                    {{ $isActive ? 'bg-[var(--color-primary)] text-white border-[var(--color-primary)] shadow-md' : 'bg-white border-gray-200 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]' }}">
                                <i class="fa-solid fa-tag text-xs"></i>
                                {{ $preset['label'] }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Category Quick Filters --}}
                    @foreach ($categories->take(3) as $cat)
                        @php
                            $isActive = ($filters['category'] ?? '') === $cat->slug;
                        @endphp
                        <a href="{{ route('client.tours', array_merge(request()->except(['category', 'page']), $isActive ? [] : ['category' => $cat->slug])) }}"
                            class="px-4 py-2.5 rounded-full border text-sm font-medium transition-all
                                {{ $isActive ? 'bg-[var(--color-primary)] text-white border-[var(--color-primary)] shadow-md' : 'bg-white border-gray-200 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 pb-12">
                {{-- Desktop Sidebar Filter --}}
                <aside class="hidden lg:block lg:col-span-3">
                    <div class="sticky top-28 space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2 pb-4 border-b border-gray-100">
                                <i class="fa-solid fa-sliders text-[var(--color-primary)]"></i>
                                Bộ lọc nâng cao
                            </h3>
                            @include('client.tours.partials._filter_form', ['isMobile' => false])
                        </div>

                        {{-- Popular Destinations Widget --}}
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 p-6 rounded-2xl border border-amber-100">
                            <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-fire text-orange-500"></i>
                                Điểm đến phổ biến
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($destinations->take(6) as $dest)
                                    <a href="{{ route('client.tours', ['destination' => $dest->slug]) }}"
                                        class="px-3 py-1.5 bg-white rounded-full text-sm text-gray-600 hover:text-[var(--color-primary)] hover:shadow-md transition-all border border-amber-200">
                                        {{ $dest->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>

                <div class="lg:col-span-9">
                    {{-- Results Header --}}
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
                        <div>
                            <h2 id="tour-list-title" class="text-2xl font-bold text-gray-800">
                                {{ $selectedCategory->name ?? 'Tất cả tour' }}
                            </h2>
                            <p class="text-gray-500 mt-1">
                                Tìm thấy <span class="font-semibold text-[var(--color-primary)]">{{ $tours->total() }}</span> tour phù hợp
                            </p>
                        </div>

                        {{-- Sort Dropdown (Mobile/Desktop) --}}
                        <div class="hidden sm:block">
                            <form id="sort-form" action="{{ route('client.tours') }}" method="GET">
                                @foreach (request()->except(['sort', 'page']) as $key => $value)
                                    @if ($value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                                <select name="sort" onchange="document.getElementById('sort-form').submit()"
                                    class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent bg-white">
                                    @foreach ($sortOptions as $value => $label)
                                        <option value="{{ $value }}" @selected(($filters['sort'] ?? 'default') == $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    {{-- Loading Skeleton --}}
                    <div x-show="isLoading" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6"
                        style="display: none;">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="bg-white rounded-2xl overflow-hidden shadow-md animate-pulse">
                                <div class="aspect-[16/10] bg-gradient-to-r from-gray-200 via-gray-100 to-gray-200 bg-[length:200%_100%] animate-shimmer"></div>
                                <div class="p-5 space-y-4">
                                    <div class="h-5 bg-gray-200 rounded-full w-4/5"></div>
                                    <div class="h-4 bg-gray-200 rounded-full w-2/3"></div>
                                    <div class="flex justify-between items-center pt-2">
                                        <div class="h-7 bg-gray-200 rounded-lg w-28"></div>
                                        <div class="h-10 bg-gray-200 rounded-xl w-24"></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- Empty State --}}
                    @if ($tours->isEmpty())
                        <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fa-solid fa-map-location-dot text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Không tìm thấy tour phù hợp</h3>
                            <p class="text-gray-500 mb-6 max-w-md mx-auto">
                                Hãy thử điều chỉnh bộ lọc hoặc tìm kiếm với từ khóa khác để tìm tour mong muốn.
                            </p>
                            <a href="{{ route('client.tours') }}"
                                class="inline-flex items-center gap-2 bg-[var(--color-primary)] text-white font-bold py-3 px-6 rounded-xl hover:bg-[var(--color-primary-dark)] transition-all shadow-lg">
                                <i class="fa-solid fa-refresh"></i>
                                Xem tất cả tour
                            </a>
                        </div>
                    @else
                        {{-- Tour List --}}
                        <div x-show="!isLoading">
                            @include('client.tours.partials.tour_list', ['tours' => $tours])
                        </div>

                        {{-- Load More Button --}}
                        <div id="pagination-container" class="mt-10 text-center">
                            @if ($tours->hasMorePages())
                                <a href="{{ $tours->nextPageUrl() }}" id="load-more-button"
                                    class="inline-flex items-center gap-3 bg-white text-gray-800 font-bold py-4 px-10 rounded-xl hover:bg-gray-50 transition-all border-2 border-gray-200 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)] text-base group">
                                    <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                                    Xem thêm tour
                                    <span class="text-sm font-normal text-gray-500">
                                        ({{ $tours->total() - $tours->count() }} tour còn lại)
                                    </span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <style>
        .irs--flat .irs-bar {
            background-color: var(--color-primary);
        }

        .irs--flat .irs-handle>i:first-child {
            background-color: var(--color-primary-dark);
        }

        .irs--flat .irs-from,
        .irs--flat .irs-to,
        .irs--flat .irs-single {
            background-color: var(--color-primary-dark);
        }

        .irs--flat .irs-from:before,
        .irs--flat .irs-to:before,
        .irs--flat .irs-single:before {
            border-top-color: var(--color-primary-dark);
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .animate-shimmer {
            animation: shimmer 1.5s infinite linear;
        }
    </style>

    <script>
        function tourFilter() {
            return {
                filterOpen: false,
                isLoading: false
            }
        }

        $(document).ready(function() {
            $(".price-range-slider").each(function() {
                const $form = $(this).closest('form');
                $(this).ionRangeSlider({
                    type: "double",
                    grid: true,
                    min: {{ $priceSliderConfig['min'] ?? 0 }},
                    max: {{ $priceSliderConfig['max'] ?? 50000000 }},
                    from: {{ $filters['price_from'] ?? $priceSliderConfig['min'] ?? 0 }},
                    to: {{ $filters['price_to'] ?? $priceSliderConfig['max'] ?? 50000000 }},
                    prefix: "đ ",
                    step: {{ $priceSliderConfig['step'] ?? 500000 }},
                    prettify_separator: ".",
                    onFinish: function(data) {
                        $form.find('.price-from').val(data.from);
                        $form.find('.price-to').val(data.to);
                    },
                });
            });
        });

        // Load More AJAX functionality
        document.addEventListener('DOMContentLoaded', function() {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer) return;

            paginationContainer.addEventListener('click', function(e) {
                const loadMoreButton = e.target.closest('#load-more-button');
                if (loadMoreButton && !loadMoreButton.disabled) {
                    e.preventDefault();
                    const url = loadMoreButton.getAttribute('href');
                    if (!url) return;

                    loadMoreButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang tải thêm...';
                    loadMoreButton.classList.add('pointer-events-none', 'opacity-70');

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.html) {
                                const tourGrid = document.getElementById('tour-grid');
                                tourGrid.insertAdjacentHTML('beforeend', data.html);
                            }

                            if (data.next_page_url) {
                                loadMoreButton.setAttribute('href', data.next_page_url);
                                loadMoreButton.innerHTML = `<i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-300"></i> Xem thêm tour`;
                                loadMoreButton.classList.remove('pointer-events-none', 'opacity-70');
                            } else {
                                paginationContainer.innerHTML = `
                                    <div class="text-center py-8 text-gray-500">
                                        <i class="fa-solid fa-check-circle text-2xl text-green-500 mb-2"></i>
                                        <p>Đã hiển thị tất cả tour</p>
                                    </div>`;
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi khi tải thêm tour:', error);
                            loadMoreButton.innerHTML = '<i class="fa-solid fa-plus"></i> Xem thêm tour';
                            loadMoreButton.classList.remove('pointer-events-none', 'opacity-70');
                        });
                }
            });
        });
    </script>
@endpush
