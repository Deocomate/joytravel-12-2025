@props(['tour'])

@if ($tour)
    <div
        class="tour-card group h-full flex flex-col rounded-2xl overflow-hidden bg-white/80 backdrop-blur-sm transition-all duration-500 hover:-translate-y-2">
        <style>
            .tour-card {
                border: 2px solid rgba(229, 231, 235, 0.8);
                box-shadow: none;
            }

            .tour-card:hover {
                border-color: var(--color-primary);
                box-shadow: none;
            }

            .tour-card-image {
                position: relative;
                overflow: hidden;
            }

            .tour-card-image::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.6) 100%);
                opacity: 0.7;
                transition: opacity 0.4s ease;
            }

            .tour-card:hover .tour-card-image::after {
                opacity: 0.5;
            }

            .tour-card-image img {
                transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .tour-card:hover .tour-card-image img {
                transform: scale(1.08);
            }

            .location-badge {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.5);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .featured-indicator {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
                box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
            }

            .price-tag {
                background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
                box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
            }

            .tour-card-cta {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
                opacity: 0;
                transform: translateY(10px);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .tour-card:hover .tour-card-cta {
                opacity: 1;
                transform: translateY(0);
            }

            .info-icon {
                color: var(--color-primary);
                opacity: 0.8;
            }
        </style>

        <a href="{{ route('client.tour.show', $tour) }}" title="{{ $tour->name ?? '' }}"
            class="block flex flex-col flex-grow">
            <!-- Image Section -->
            <div class="tour-card-image relative h-52">
                <img class="w-full h-full object-cover"
                    src="{{ $tour->thumbnail ?? '/userfiles/images/placeholder.jpg' }}"
                    alt="{{ $tour->name ?? 'Hình ảnh tour' }}" loading="lazy">

                <!-- Location Badge with Glassmorphism -->
                <div
                    class="location-badge absolute top-3 left-3 z-10 px-3 py-1.5 rounded-full flex items-center gap-x-1.5">
                    <i class="fa-solid fa-location-dot text-[var(--color-primary)] text-sm"></i>
                    <span
                        class="text-gray-800 text-xs font-semibold">{{ $tour->destinations->first()->name ?? 'Nhiều nơi' }}</span>
                </div>

                <!-- Featured Indicator (optional) -->
                @if ($tour->is_featured ?? false)
                    <div class="featured-indicator absolute top-3 right-3 z-10 px-2.5 py-1 rounded-full">
                        <span class="text-white text-xs font-bold flex items-center gap-1">
                            <i class="fa-solid fa-star text-[10px]"></i> Nổi bật
                        </span>
                    </div>
                @endif

                <!-- Duration Badge -->
                <div
                    class="absolute bottom-3 left-3 z-10 bg-black/60 backdrop-blur-sm text-white text-xs px-2.5 py-1 rounded-lg flex items-center gap-1.5">
                    <i class="fa-regular fa-clock"></i>
                    <span class="font-medium">{{ $tour->duration ?? 'N/A' }}</span>
                </div>

                <!-- Price Tag Overlay -->
                <div class="price-tag absolute bottom-3 right-3 z-10 px-3 py-1.5 rounded-lg">
                    <span class="text-white text-[10px] font-medium block leading-none opacity-90">Từ</span>
                    <span
                        class="text-white text-lg font-extrabold leading-tight">{{ number_format($tour->price_adult ?? 0) }}đ</span>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-5 flex flex-col flex-grow relative">
                <!-- Tour Name -->
                <h3
                    class="font-bold text-gray-800 text-base leading-snug h-12 overflow-hidden group-hover:text-[var(--color-primary)] transition-colors duration-300 [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical]">
                    {{ $tour->name ?? 'Tên tour đang được cập nhật' }}
                </h3>

                <!-- Rating Display -->
                <div class="flex items-center gap-2 mt-2">
                    <div class="flex gap-0.5">
                        @for ($i = 0; $i < 5; $i++)
                            <i
                                class="fa-solid fa-star text-xs {{ $i < ($tour->rating ?? 5) ? 'text-amber-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-500">({{ $tour->reviews_count ?? rand(10, 50) }} đánh giá)</span>
                </div>

                <!-- Tour Details -->
                <div class="mt-4 space-y-2.5 flex-grow">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fa-regular fa-clock info-icon w-5 text-center"></i>
                        <span class="ml-2">Lịch trình: <strong
                                class="text-gray-800">{{ $tour->duration ?? 'N/A' }}</strong></span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fa-regular fa-calendar-check info-icon w-5 text-center"></i>
                        <span class="ml-2">Khởi hành: <strong class="text-gray-800">Liên hệ</strong></span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fa-solid fa-users info-icon w-5 text-center"></i>
                        <span class="ml-2">Còn nhận: <strong
                                class="text-gray-800">{{ $tour->remaining_slots ?? 'N/A' }}</strong></span>
                    </div>
                </div>

                <!-- CTA Button (appears on hover) -->
                <div class="tour-card-cta mt-4 py-2.5 rounded-lg text-center">
                    <span class="text-white font-semibold text-sm flex items-center justify-center gap-2">
                        Xem chi tiết <i class="fa-solid fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </div>
        </a>
    </div>
@endif
