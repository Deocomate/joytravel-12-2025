@props(['news'])

@if ($news)
    <article
        class="news-card group h-full flex flex-col rounded-2xl overflow-hidden bg-white cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl border border-gray-100 hover:border-primary/30">

        <a href="{{ route('client.news.show', $news) }}" title="{{ $news->title ?? '' }}"
            class="flex flex-col flex-grow" aria-label="Đọc tin {{ $news->title ?? '' }}">
            {{-- Image Section --}}
            <div class="relative h-44 sm:h-48 overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    src="{{ $news->thumbnail ?? '/userfiles/images/placeholder.jpg' }}"
                    alt="{{ $news->title ?? 'Hình ảnh tin tức' }}" loading="lazy">

                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                {{-- Date Badge --}}
                <div
                    class="absolute top-3 left-3 z-10 px-2.5 py-1.5 rounded-xl bg-white/95 backdrop-blur-sm shadow-sm text-center min-w-[48px]">
                    <span class="text-primary text-lg font-bold block leading-none">
                        {{ optional($news->created_at)->format('d') }}
                    </span>
                    <span class="text-gray-500 text-[9px] font-semibold uppercase tracking-wide">
                        Th{{ optional($news->created_at)->format('m') }}
                    </span>
                </div>

                {{-- Category Badge --}}
                @if ($news->category)
                    <div
                        class="absolute top-3 right-3 z-10 px-2.5 py-1 rounded-full bg-gradient-to-r from-primary to-amber-500 shadow-md">
                        <span class="text-white text-[10px] font-semibold">{{ $news->category->name }}</span>
                    </div>
                @endif

                {{-- Reading Time --}}
                <div class="absolute bottom-3 left-3 z-10 px-2.5 py-1 rounded-full bg-black/50 backdrop-blur-sm">
                    <span class="text-white text-[11px] font-medium flex items-center gap-1">
                        <i class="fa-regular fa-clock text-[10px]"></i>
                        {{ ceil(str_word_count(strip_tags($news->content ?? '')) / 200) ?: 3 }} phút
                    </span>
                </div>
            </div>

            {{-- Content Section --}}
            <div class="p-4 flex flex-col flex-grow">
                {{-- Title --}}
                <h3
                    class="font-bold text-gray-800 text-sm sm:text-base leading-snug min-h-[2.5rem] group-hover:text-primary transition-colors duration-200 overflow-hidden [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical]">
                    {{ $news->title ?? 'Tiêu đề tin tức đang được cập nhật' }}
                </h3>

                {{-- Description --}}
                <p
                    class="mt-2 text-xs sm:text-sm text-gray-500 flex-grow overflow-hidden [display:-webkit-box] [-webkit-line-clamp:2] [-webkit-box-orient:vertical] leading-relaxed">
                    {{ $news->short_description ?? '' }}
                </p>

                {{-- Footer --}}
                <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-[11px] text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="fa-regular fa-eye"></i>
                            {{ number_format($news->view ?? 0) }}
                        </span>
                    </div>
                    <span
                        class="text-primary text-xs font-semibold flex items-center gap-1 group-hover:gap-1.5 transition-all">
                        Đọc thêm
                        <i class="fa-solid fa-arrow-right text-[10px] transition-transform group-hover:translate-x-0.5"></i>
                    </span>
                </div>
            </div>
        </a>
    </article>
@endif
