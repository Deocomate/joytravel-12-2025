@props(['tour'])

@if ($tour)
    <article
        class="tour-card group h-full flex flex-col rounded-2xl overflow-hidden bg-white cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl border border-gray-100 hover:border-primary/30">

        <a href="{{ route('client.tour.show', $tour) }}" title="{{ $tour->name ?? '' }}"
            class="flex flex-col flex-grow" aria-label="Xem chi tiết tour {{ $tour->name ?? '' }}">
            {{-- Image Section --}}
            <div class="relative h-48 sm:h-52 overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    src="{{ $tour->thumbnail ?? '/userfiles/images/placeholder.jpg' }}"
                    alt="{{ $tour->name ?? 'Hình ảnh tour' }}" loading="lazy">

                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                {{-- Location Badge --}}
                <div
                    class="absolute top-3 left-3 z-10 px-2.5 py-1.5 rounded-full bg-white/90 backdrop-blur-sm border border-white/50 shadow-sm flex items-center gap-1.5">
                    <i class="fa-solid fa-location-dot text-primary text-xs"></i>
                    <span class="text-gray-800 text-xs font-semibold truncate max-w-[120px]">
                        {{ $tour->destinations->first()->name ?? 'Nhiều nơi' }}
                    </span>
                </div>

                {{-- Featured Badge --}}
                @if ($tour->is_featured ?? false)
                    <div
                        class="absolute top-3 right-3 z-10 px-2 py-1 rounded-full bg-gradient-to-r from-primary to-amber-500 shadow-lg shadow-primary/30">
                        <span class="text-white text-[10px] font-bold flex items-center gap-1">
                            <i class="fa-solid fa-crown"></i> HOT
                        </span>
                    </div>
                @endif

                {{-- Bottom Info Bar --}}
                <div class="absolute bottom-0 left-0 right-0 p-3 flex items-end justify-between">
                    {{-- Duration Badge --}}
                    <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-black/50 backdrop-blur-sm">
                        <i class="fa-regular fa-clock text-white/90 text-xs"></i>
                        <span class="text-white text-xs font-medium">{{ $tour->duration ?? 'N/A' }}</span>
                    </div>

                    {{-- Price Tag --}}
                    <div class="px-3 py-1.5 rounded-lg bg-red-600 shadow-lg">
                        <span class="text-white/80 text-[10px] font-medium block leading-none">Từ</span>
                        <span class="text-white text-base font-bold leading-tight">
                            {{ number_format($tour->price_adult ?? 0) }}đ
                        </span>
                    </div>
                </div>
            </div>

            {{-- Content Section --}}
            <div class="p-4 flex flex-col flex-grow">
                {{-- Tour Name --}}
                <h3
                    class="font-bold text-gray-800 text-sm sm:text-base leading-snug min-h-[2.5rem] overflow-hidden group-hover:text-primary transition-colors duration-200 [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical]">
                    {{ $tour->name ?? 'Tên tour đang được cập nhật' }}
                </h3>

                {{-- Rating --}}
                <div class="flex items-center gap-2 mt-2">
                    <div class="flex gap-0.5" aria-label="Đánh giá {{ $tour->rating ?? 5 }} sao">
                        @for ($i = 0; $i < 5; $i++)
                            <i
                                class="fa-solid fa-star text-[10px] {{ $i < ($tour->rating ?? 5) ? 'text-amber-400' : 'text-gray-200' }}"></i>
                        @endfor
                    </div>
                    <span class="text-[11px] text-gray-500">({{ $tour->reviews_count ?? rand(10, 50) }})</span>
                </div>

                {{-- Quick Info --}}
                <div class="mt-3 pt-3 border-t border-gray-100 space-y-2 flex-grow">
                    <div class="flex items-center text-xs text-gray-600">
                        <i class="fa-regular fa-calendar-check text-primary/70 w-4"></i>
                        <span class="ml-1.5">Khởi hành: <strong class="text-gray-700">Liên hệ</strong></span>
                    </div>
                    <div class="flex items-center text-xs text-gray-600">
                        <i class="fa-solid fa-users text-primary/70 w-4"></i>
                        <span class="ml-1.5">Còn nhận: <strong
                                class="text-gray-700">{{ $tour->remaining_slots ?? 'Liên hệ' }}</strong></span>
                    </div>
                </div>

                {{-- CTA --}}
                <div
                    class="mt-3 py-2 rounded-lg bg-gray-50 group-hover:bg-primary text-center transition-all duration-300">
                    <span
                        class="text-gray-600 group-hover:text-white font-semibold text-xs flex items-center justify-center gap-1.5 transition-colors">
                        Xem chi tiết
                        <i class="fa-solid fa-arrow-right text-[10px] transition-transform group-hover:translate-x-0.5"></i>
                    </span>
                </div>
            </div>
        </a>
    </article>
@endif
