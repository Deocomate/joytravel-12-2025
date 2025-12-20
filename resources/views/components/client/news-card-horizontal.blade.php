@props(['news'])

@if($news)
    <div class="news-card-horizontal group rounded-2xl overflow-hidden transition-all duration-500 hover:-translate-y-1">
        <style>
            .news-card-horizontal {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
                border: 1px solid rgba(255, 255, 255, 0.7);
            }
            .news-card-horizontal:hover {
                box-shadow: 0 16px 32px rgba(245, 158, 11, 0.1), 0 6px 12px rgba(0, 0, 0, 0.06);
                border-color: rgba(245, 158, 11, 0.25);
            }
            .news-horizontal-image {
                position: relative;
                overflow: hidden;
            }
            .news-horizontal-image::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, transparent 50%);
                opacity: 0.6;
                transition: opacity 0.4s ease;
            }
            .news-card-horizontal:hover .news-horizontal-image::after {
                opacity: 0.3;
            }
            .news-horizontal-image img {
                transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .news-card-horizontal:hover .news-horizontal-image img {
                transform: scale(1.06);
            }
            .news-h-category-badge {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
                box-shadow: 0 2px 8px rgba(245, 158, 11, 0.35);
            }
            .news-h-meta-item {
                position: relative;
                transition: color 0.3s ease;
            }
            .news-h-meta-item:hover {
                color: var(--color-primary);
            }
            .news-h-read-indicator {
                width: 32px;
                height: 32px;
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transform: translateX(-10px);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            }
            .news-card-horizontal:hover .news-h-read-indicator {
                opacity: 1;
                transform: translateX(0);
            }
            .news-h-divider {
                width: 40px;
                height: 3px;
                background: linear-gradient(90deg, var(--color-primary), var(--color-primary-accent));
                border-radius: 2px;
                transition: width 0.4s ease;
            }
            .news-card-horizontal:hover .news-h-divider {
                width: 60px;
            }
        </style>

        <a href="{{ route('client.news.show', $news) }}" title="{{ $news->title ?? '' }}" class="flex flex-col md:flex-row">
            <!-- Image Section - 40% width on desktop -->
            <div class="news-horizontal-image md:w-2/5 flex-shrink-0 relative">
                <img class="w-full h-48 md:h-full md:min-h-[200px] object-cover"
                     src="{{ $news->thumbnail ?? 'https://placehold.co/400x300/e2e8f0/e2e8f0?text=King+Express' }}"
                     alt="{{ $news->title ?? 'Hình ảnh tin tức' }}" loading="lazy">

                <!-- Category Badge -->
                @if($news->category)
                <div class="news-h-category-badge absolute top-4 left-4 z-10 px-3.5 py-1.5 rounded-full">
                    <span class="text-white text-xs font-bold tracking-wide">{{ $news->category->name }}</span>
                </div>
                @endif
            </div>

            <!-- Content Section - 60% width on desktop -->
            <div class="p-5 md:p-6 flex flex-col flex-grow bg-transparent md:w-3/5">
                <!-- Decorative Divider -->
                <div class="news-h-divider mb-4"></div>

                <!-- Title -->
                <h3 class="font-bold text-gray-800 text-lg md:text-xl leading-tight group-hover:text-[var(--color-primary)] transition-colors duration-300 [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical] overflow-hidden">
                    {{ $news->title ?? 'Tiêu đề tin tức đang được cập nhật' }}
                </h3>

                <!-- Metadata -->
                <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-xs text-gray-500">
                    <span class="news-h-meta-item flex items-center gap-1.5">
                        <i class="fa-regular fa-user"></i>
                        <span class="font-medium">Admin</span>
                    </span>
                    <span class="news-h-meta-item flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span>{{ optional($news->created_at)->format('d/m/Y') }}</span>
                    </span>
                    <span class="news-h-meta-item flex items-center gap-1.5">
                        <i class="fa-regular fa-eye"></i>
                        <span>{{ number_format($news->view ?? 0) }} lượt xem</span>
                    </span>
                </div>

                <!-- Description -->
                <div class="mt-4 text-sm text-gray-600 flex-grow overflow-hidden [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical] leading-relaxed">
                    {{ $news->short_description ?? '' }}
                </div>

                <!-- Footer with Read Indicator -->
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-xs text-gray-400 flex items-center gap-1">
                        <i class="fa-regular fa-clock"></i>
                        {{ ceil(str_word_count(strip_tags($news->content ?? '')) / 200) ?: 3 }} phút đọc
                    </span>
                    <div class="news-h-read-indicator">
                        <i class="fa-solid fa-arrow-right text-white text-xs"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endif
