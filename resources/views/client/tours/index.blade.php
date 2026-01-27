@extends('client.layouts.app')

@section('title', $selectedCategory->name ?? 'Danh sách Tour du lịch')
@section('description',
    'Khám phá các tour du lịch hấp dẫn trong và ngoài nước được tổ chức bởi King Express Travel. Đa
    dạng lựa chọn, giá cả cạnh tranh.')

@section('content')
    <div x-data="tourFilter()" class="py-6 md:py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 md:mb-12">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 uppercase">Tour Du Lịch</h1>
                <p class="text-gray-600 mt-2">Khám phá thế giới qua những hành trình đầy cảm hứng từ King Express Travel.</p>
            </div>

            {{-- Mobile Filter Toggle Bar --}}
            <div
                class="lg:hidden sticky top-[120px] z-40 bg-white border-b p-4 flex justify-between items-center shadow-sm -mx-4 mb-6">
                <span class="font-semibold text-gray-800">
                    {{ $tours->total() }} tour được tìm thấy
                </span>
                <button @click="filterOpen = true"
                    class="flex items-center gap-2 bg-[var(--color-primary)] text-white px-4 py-2 rounded-full font-medium hover:bg-[var(--color-primary-dark)] transition-colors"
                    aria-label="Mở bộ lọc">
                    <i class="fa-solid fa-filter"></i>
                    Bộ lọc
                </button>
            </div>

            {{-- Mobile Filter Drawer Overlay --}}
            <div x-show="filterOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="filterOpen = false"
                class="fixed inset-0 bg-black/50 z-50 lg:hidden" style="display: none;"></div>

            {{-- Mobile Filter Drawer Panel --}}
            <div x-show="filterOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full" x-trap.noscroll="filterOpen"
                @keydown.escape.window="filterOpen = false"
                class="fixed inset-y-0 right-0 w-full max-w-sm bg-white z-50 lg:hidden overflow-y-auto shadow-xl"
                style="display: none;">

                <div class="sticky top-0 bg-white border-b p-4 flex justify-between items-center z-10">
                    <h2 class="font-bold text-lg">Bộ lọc tìm kiếm</h2>
                    <button @click="filterOpen = false" class="p-2 hover:bg-gray-100 rounded-full transition-colors"
                        aria-label="Đóng bộ lọc">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <div class="p-4">
                    @include('client.tours.partials._filter_form', ['isMobile' => true])
                </div>

                <div class="sticky bottom-0 bg-white border-t p-4 flex gap-3">
                    <a href="{{ route('client.tours') }}"
                        class="flex-1 py-3 border border-gray-300 rounded-lg font-medium text-center hover:bg-gray-50 transition-colors">
                        Xóa bộ lọc
                    </a>
                    <button type="submit" form="mobile-filter-form"
                        class="flex-1 py-3 bg-[var(--color-primary)] text-white rounded-lg font-bold hover:bg-[var(--color-primary-dark)] transition-colors">
                        Áp dụng
                    </button>
                </div>
            </div>

            {{-- Quick Filter Pills --}}
            <div class="overflow-x-auto pb-2 mb-6 -mx-4 px-4 lg:mx-0 lg:px-0 scrollbar-hide">
                <div class="flex gap-2 whitespace-nowrap">
                    <button @click="applyQuickFilter('price', 'under2m')"
                        :class="activeFilters.price === 'under2m' ?
                            'bg-[var(--color-primary)] text-white border-[var(--color-primary)]' :
                            'border-gray-200 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]'"
                        class="px-4 py-2 rounded-full border text-sm font-medium transition-colors">
                        <i class="fa-solid fa-tag mr-1"></i> Giá dưới 2 triệu
                    </button>
                    <button @click="applyQuickFilter('duration', 'weekend')"
                        :class="activeFilters.duration === 'weekend' ?
                            'bg-[var(--color-primary)] text-white border-[var(--color-primary)]' :
                            'border-gray-200 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]'"
                        class="px-4 py-2 rounded-full border text-sm font-medium transition-colors">
                        <i class="fa-regular fa-calendar mr-1"></i> Cuối tuần
                    </button>
                    @foreach ($categories->take(4) as $cat)
                        <button @click="applyQuickFilter('category', '{{ $cat->slug }}')"
                            :class="activeFilters.category === '{{ $cat->slug }}' ?
                                'bg-[var(--color-primary)] text-white border-[var(--color-primary)]' :
                                'border-gray-200 hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]'"
                            class="px-4 py-2 rounded-full border text-sm font-medium transition-colors">
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Desktop Sidebar Filter --}}
                <aside class="hidden lg:block lg:col-span-3">
                    <div class="sticky top-28 space-y-6">
                        <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-sliders text-[var(--color-primary)]"></i>
                                Bộ lọc tìm kiếm
                            </h3>
                            @include('client.tours.partials._filter_form', ['isMobile' => false])
                        </div>
                    </div>
                </aside>

                <div class="lg:col-span-9">
                    <div class="flex justify-between items-center mb-4">
                        <h2 id="tour-list-title" class="text-2xl font-bold text-gray-800">
                            {{ $selectedCategory->name ?? 'Tất cả tour' }}</h2>
                        <span class="hidden lg:inline text-sm text-gray-500">{{ $tours->total() }} kết quả</span>
                    </div>

                    {{-- Loading Skeleton (hidden by default) --}}
                    <div x-show="isLoading" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6"
                        style="display: none;">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="bg-white rounded-2xl overflow-hidden shadow-sm animate-pulse">
                                <div class="aspect-[16/10] bg-gray-200"></div>
                                <div class="p-4 space-y-3">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                                    <div class="flex justify-between items-center mt-4">
                                        <div class="h-6 bg-gray-200 rounded w-24"></div>
                                        <div class="h-4 bg-gray-200 rounded w-12"></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- Tour List --}}
                    <div x-show="!isLoading" id="tour-list-container">
                        @include('client.tours.partials.tour_list', ['tours' => $tours])
                    </div>

                    <div id="pagination-container" class="mt-10 text-center">
                        @if ($tours->hasMorePages())
                            <a href="{{ $tours->nextPageUrl() }}" id="load-more-button"
                                class="inline-flex items-center gap-2 bg-[var(--color-primary)] text-white font-bold py-3 px-8 rounded-lg hover:bg-[var(--color-primary-dark)] transition-all hover:shadow-lg text-base">
                                <i class="fa-solid fa-plus"></i>
                                Xem thêm
                            </a>
                        @endif
                    </div>
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
    </style>

    <script>
        function tourFilter() {
            return {
                filterOpen: false,
                isLoading: false,
                activeFilters: {
                    price: '{{ request('quick_price', '') }}',
                    duration: '{{ request('quick_duration', '') }}',
                    category: '{{ $selectedCategorySlug ?? '' }}'
                },
                applyQuickFilter(type, value) {
                    if (this.activeFilters[type] === value) {
                        this.activeFilters[type] = '';
                    } else {
                        this.activeFilters[type] = value;
                    }
                    this.submitFilters();
                },
                submitFilters() {
                    const params = new URLSearchParams(window.location.search);

                    if (this.activeFilters.price === 'under2m') {
                        params.set('price_from', '1000000');
                        params.set('price_to', '2000000');
                    } else {
                        params.delete('quick_price');
                    }

                    if (this.activeFilters.duration === 'weekend') {
                        params.set('quick_duration', 'weekend');
                    } else {
                        params.delete('quick_duration');
                    }

                    if (this.activeFilters.category) {
                        params.set('category', this.activeFilters.category);
                    }

                    window.location.search = params.toString();
                }
            }
        }

        $(document).ready(function() {
            $(".price-range-slider").each(function() {
                $(this).ionRangeSlider({
                    type: "double",
                    grid: true,
                    min: 1000000,
                    max: 50000000,
                    from: {{ request('price_from', 1000000) }},
                    to: {{ request('price_to', 50000000) }},
                    prefix: "đ ",
                    step: 500000,
                    prettify_separator: ".",
                    onFinish: function(data) {
                        $(data.input).closest('form').find('.price-from').val(data.from);
                        $(data.input).closest('form').find('.price-to').val(data.to);
                    },
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer) return;

            paginationContainer.addEventListener('click', function(e) {
                const loadMoreButton = e.target.closest('#load-more-button');
                if (loadMoreButton && !loadMoreButton.disabled) {
                    e.preventDefault();
                    const url = loadMoreButton.getAttribute('href');
                    if (!url) return;

                    loadMoreButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang tải...';
                    loadMoreButton.disabled = true;

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.html) {
                                const tourListContainer = document.getElementById(
                                    'tour-list-container');
                                tourListContainer.insertAdjacentHTML('beforeend', data.html);
                            }

                            const nextUrl = data.next_page_url;

                            if (nextUrl) {
                                loadMoreButton.setAttribute('href', nextUrl);
                                loadMoreButton.innerHTML = '<i class="fa-solid fa-plus"></i> Xem thêm';
                                loadMoreButton.disabled = false;
                            } else {
                                paginationContainer.remove();
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi khi tải thêm tour:', error);
                            if (loadMoreButton) {
                                loadMoreButton.innerHTML = '<i class="fa-solid fa-plus"></i> Xem thêm';
                                loadMoreButton.disabled = false;
                            }
                        });
                }
            });
        });
    </script>
@endpush
