{{-- Skeleton Loading State --}}
<template id="tour-skeleton-template">
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
</template>

{{-- Tour Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($tours as $tour)
        <x-client.tour-card :tour="$tour" />
    @empty
        <div class="col-span-full text-center py-16">
            <div class="bg-gray-50 rounded-2xl p-8 max-w-md mx-auto">
                <i class="fa-solid fa-map-location-dot text-6xl text-gray-300"></i>
                <h3 class="mt-4 text-lg font-semibold text-gray-700">Không tìm thấy tour</h3>
                <p class="mt-2 text-gray-500">Không có tour nào phù hợp với tiêu chí tìm kiếm của bạn. Hãy thử điều
                    chỉnh bộ lọc.</p>
                <a href="{{ route('client.tours') }}"
                    class="inline-flex items-center gap-2 mt-4 text-[var(--color-primary)] hover:text-[var(--color-primary-dark)] font-medium">
                    <i class="fa-solid fa-arrow-left"></i>
                    Xem tất cả tour
                </a>
            </div>
        </div>
    @endforelse
</div>
