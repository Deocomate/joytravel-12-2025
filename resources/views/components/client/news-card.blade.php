@props(['news'])

@if($news)
    <div
        class="news-card group h-full flex flex-col rounded-2xl overflow-hidden bg-white/80 backdrop-blur-sm transition-all duration-500 hover:-translate-y-2">
        <style>
            .news-card {
                border: 2px solid rgba(229, 231, 235, 0.8);
                box-shadow: none;
            }

            .news-card:hover {
                border-color: var(--color-primary);
                box-shadow: none;
            }

            .news-card-image {
                position: relative;
                overflow: hidden;
            }

            .news-card-image::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(180deg, rgba(0, 0, 0, 0.1) 0%, transparent 30%, transparent 60%, rgba(0, 0, 0, 0.4) 100%);
                opacity: 0.8;
                transition: opacity 0.4s ease;
            }

            .news-card:hover .news-card-image::after {
                opacity: 0.6;
            }

            .news-card-image img {
                transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .news-card:hover .news-card-image img {
                transform: scale(1.08);
            }

            .news-date-badge {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.5);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .news-category-badge {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
                box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
            }

            .news-read-more {
                color: var(--color-primary);
                position: relative;
            }

            .news-read-more::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;
                background: linear-gradient(90deg, var(--color-primary), var(--color-primary-dark));
                transition: width 0.3s ease;
            }

            .news-card:hover .news-read-more::after {
                width: 100%;
            }

            .reading-time {
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }
        </style>

        <a href="{{ route('client.news.show', $news) }}" title="{{ $news->title ?? '' }}"
            class="block flex flex-col flex-grow">
            <!-- Image Section -->
            <div class="news-card-image relative h-52">
                <img class="w-full h-full object-cover" src="{{ $news->thumbnail ?? '/userfiles/images/placeholder.jpg' }}"
                    alt="{{ $news->title ?? 'Hình ảnh tin tức' }}" loading="lazy">

                <!-- Date Badge -->
                <div class="news-date-badge absolute top-3 left-3 z-10 px-3 py-2 rounded-xl text-center min-w-[56px]">
                    <span
                        class="text-[var(--color-primary)] text-lg font-bold block leading-none">{{ optional($news->created_at)->format('d') }}</span>
                    <span
                        class="text-gray-600 text-[10px] font-semibold uppercase tracking-wide">Th{{ optional($news->created_at)->format('m') }}</span>
                </div>

                <!-- Reading Time -->
                <div class="reading-time absolute bottom-3 left-3 z-10 px-2.5 py-1 rounded-full">
                    <span class="text-white text-xs font-medium flex items-center gap-1">
                        <i class="fa-regular fa-clock text-[10px]"></i>
                        {{ ceil(str_word_count(strip_tags($news->content ?? '')) / 200) ?: 3 }} phút đọc
                    </span>
                </div>

                <!-- Category Badge -->
                @if($news->category)
                    <div class="news-category-badge absolute top-3 right-3 z-10 px-3 py-1 rounded-full">
                        <span class="text-white text-xs font-semibold">{{ $news->category->name }}</span>
                    </div>
                @endif
            </div>

            <!-- Content Section -->
            <div class="p-5 flex flex-col flex-grow">
                <!-- Title -->
                <h3
                    class="font-bold text-gray-800 text-base leading-snug group-hover:text-[var(--color-primary)] transition-colors duration-300 overflow-hidden [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical]">
                    {{ $news->title ?? 'Tiêu đề tin tức đang được cập nhật' }}
                </h3>

                <!-- Description -->
                <div
                    class="mt-3 text-sm text-gray-600 flex-grow overflow-hidden [display:-webkit-box] [-webkit-line-clamp:3] [-webkit-box-orient:vertical] leading-relaxed">
                    {{ $news->short_description ?? '' }}
                </div>

                <!-- Footer -->
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3 text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="fa-regular fa-eye"></i>
                            {{ $news->view ?? 0 }}
                        </span>
                    </div>
                    <span class="news-read-more text-sm font-semibold flex items-center gap-1">
                        Đọc thêm <i
                            class="fa-solid fa-arrow-right text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
                    </span>
                </div>
            </div>
        </a>
    </div>
@endif