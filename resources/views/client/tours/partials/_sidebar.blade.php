{{-- Desktop Sticky Sidebar --}}
<div class="hidden lg:block sticky top-28 space-y-6">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        {{-- Price Header with Gradient --}}
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-5 text-white">
            <span class="text-sm opacity-90">Giá chỉ từ</span>
            <p class="text-3xl font-extrabold tracking-tight">{{ number_format($tour->price_adult ?? 0) }}đ</p>
            <span class="text-sm opacity-90">/ người lớn</span>
        </div>

        {{-- Quick Info --}}
        <div class="p-5 space-y-3 border-b border-gray-100">
            <div class="flex items-center gap-3 text-gray-700">
                <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center">
                    <i class="fa-regular fa-clock text-amber-500"></i>
                </div>
                <span class="font-medium">{{ $tour->duration ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center gap-3 text-gray-700">
                <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center">
                    <i class="fa-regular fa-calendar-check text-amber-500"></i>
                </div>
                <span class="font-medium">Khởi hành: Hàng ngày</span>
            </div>
            <div class="flex items-center gap-3 text-gray-700">
                <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center">
                    <i class="fa-solid fa-car text-amber-500"></i>
                </div>
                <span class="font-medium">{{ $tour->transport_mode ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center gap-3 text-gray-700">
                <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center">
                    <i class="fa-solid fa-map-pin text-amber-500"></i>
                </div>
                <span class="font-medium">{{ $tour->departure_point ?? 'N/A' }}</span>
            </div>
            @if (isset($tour->destinations) && !$tour->destinations->isEmpty())
                <div class="flex items-start gap-3 text-gray-700">
                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="fa-solid fa-route text-amber-500"></i>
                    </div>
                    <span class="font-medium">{{ $tour->destinations->pluck('name')->join(' - ') }}</span>
                </div>
            @endif
        </div>

        {{-- CTA Buttons --}}
        <div class="p-5 space-y-3">
            <a href="{{ route('client.checkout', $tour) }}"
                class="group block w-full text-center bg-[var(--color-primary)] hover:bg-[var(--color-primary-dark)] text-white font-bold py-4 rounded-xl transition-all hover:shadow-lg hover:-translate-y-0.5">
                <i class="fa-solid fa-paper-plane mr-2 group-hover:translate-x-1 transition-transform"></i>
                Đặt tour ngay
            </a>
            <button type="button"
                class="w-full py-3 border-2 border-[var(--color-primary)] text-[var(--color-primary)] font-bold rounded-xl hover:bg-amber-50 transition-colors flex items-center justify-center gap-2"
                onclick="window.open('tel:{{ config('site.phone', '0987654321') }}')">
                <i class="fa-solid fa-phone"></i>
                Liên hệ tư vấn
            </button>
        </div>
    </div>

    {{-- Why Choose Us Card --}}
    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-5 border border-gray-200">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-shield-halved text-[var(--color-primary)]"></i>
            Cam kết của chúng tôi
        </h4>
        <ul class="space-y-3 text-sm text-gray-600">
            <li class="flex items-center gap-2">
                <i class="fa-solid fa-check text-green-500"></i>
                Đảm bảo giá tốt nhất
            </li>
            <li class="flex items-center gap-2">
                <i class="fa-solid fa-check text-green-500"></i>
                Hỗ trợ 24/7
            </li>
            <li class="flex items-center gap-2">
                <i class="fa-solid fa-check text-green-500"></i>
                Hoàn tiền nếu không hài lòng
            </li>
            <li class="flex items-center gap-2">
                <i class="fa-solid fa-check text-green-500"></i>
                Hướng dẫn viên chuyên nghiệp
            </li>
        </ul>
    </div>
</div>

{{-- Mobile Bottom Booking Bar --}}
<div
    class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-sm border-t border-gray-200 shadow-[0_-4px_20px_rgba(0,0,0,0.1)] p-4 lg:hidden z-40 safe-area-bottom">
    <div class="flex items-center justify-between gap-4">
        <div>
            <span class="text-xs text-gray-500">Giá từ</span>
            <p class="text-xl font-extrabold text-red-600">{{ number_format($tour->price_adult ?? 0) }}đ</p>
        </div>
        <div class="flex gap-2">
            <a href="tel:{{ config('site.phone', '0987654321') }}"
                class="w-12 h-12 flex items-center justify-center border-2 border-[var(--color-primary)] text-[var(--color-primary)] rounded-xl hover:bg-amber-50 transition-colors"
                aria-label="Gọi điện tư vấn">
                <i class="fa-solid fa-phone"></i>
            </a>
            <a href="{{ route('client.checkout', $tour) }}"
                class="bg-[var(--color-primary)] hover:bg-[var(--color-primary-dark)] text-white font-bold py-3 px-6 rounded-xl transition-all flex items-center gap-2">
                <span>Đặt tour</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
