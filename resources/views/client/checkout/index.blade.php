@extends('client.layouts.app')

@section('title', 'Đặt Tour - ' . ($tour->name ?? ''))
@section('description', 'Hoàn tất thông tin đặt tour ' . ($tour->name ?? '') . ' và sẵn sàng cho chuyến đi của bạn.')

@push('styles')
    <style>
        /* Progress Steps */
        .checkout-step {
            transition: all 0.3s ease;
        }

        .checkout-step.active .step-number {
            background: var(--color-primary);
            color: white;
            transform: scale(1.1);
        }

        .checkout-step.completed .step-number {
            background: #10b981;
            color: white;
        }

        .checkout-step.completed .step-number i {
            display: block;
        }

        .checkout-step.completed .step-number span {
            display: none;
        }

        /* Form Sections */
        .form-section {
            transition: all 0.3s ease;
        }

        .form-section:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Quantity Controls */
        .quantity-control {
            display: flex;
            align-items: center;
            background: #f3f4f6;
            border-radius: 9999px;
            padding: 4px;
        }

        .quantity-control button {
            width: 36px;
            height: 36px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .quantity-control button:hover:not(:disabled) {
            background: var(--color-primary);
            color: white;
        }

        .quantity-control button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .quantity-control input {
            width: 50px;
            text-align: center;
            background: transparent;
            border: none;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .quantity-control input:focus {
            outline: none;
        }

        /* Payment Method */
        .payment-option {
            transition: all 0.2s ease;
            border: 2px solid #e5e7eb;
        }

        .payment-option:hover:not(.disabled) {
            border-color: var(--color-primary);
        }

        .payment-option.selected {
            border-color: var(--color-primary);
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(245, 158, 11, 0.1) 100%);
        }

        .payment-option.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #f9fafb;
        }

        /* Tour Card */
        .tour-summary-card {
            background: linear-gradient(135deg, #fff 0%, #fefce8 100%);
        }

        /* Sticky Sidebar */
        @media (min-width: 1024px) {
            .checkout-sidebar {
                position: sticky;
                top: 100px;
            }
        }

        /* Submit Button Animation */
        .submit-btn {
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        /* Price Animation */
        .price-update {
            animation: priceFlash 0.3s ease;
        }

        @keyframes priceFlash {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-amber-50 to-white py-6 md:py-10">
        <div class="container mx-auto px-4">

            {{-- Header with Progress Steps --}}
            <div class="text-center mb-8">
                <h1 class="text-2xl md:text-4xl font-extrabold text-gray-800 mb-4">
                    <i class="fa-solid fa-plane-departure text-[var(--color-primary)] mr-2"></i>
                    Đặt Tour Du Lịch
                </h1>

                {{-- Progress Steps --}}
                <div class="flex items-center justify-center gap-4 md:gap-8 mt-6">
                    <div class="checkout-step active flex items-center gap-2">
                        <div class="step-number w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 transition-all">
                            <span>1</span>
                            <i class="fa-solid fa-check hidden"></i>
                        </div>
                        <span class="hidden md:block font-medium text-gray-800">Thông tin</span>
                    </div>
                    <div class="w-12 md:w-20 h-1 bg-gray-200 rounded-full"></div>
                    <div class="checkout-step flex items-center gap-2">
                        <div class="step-number w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 transition-all">
                            <span>2</span>
                            <i class="fa-solid fa-check hidden"></i>
                        </div>
                        <span class="hidden md:block font-medium text-gray-500">Xác nhận</span>
                    </div>
                    <div class="w-12 md:w-20 h-1 bg-gray-200 rounded-full"></div>
                    <div class="checkout-step flex items-center gap-2">
                        <div class="step-number w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 transition-all">
                            <span>3</span>
                            <i class="fa-solid fa-check hidden"></i>
                        </div>
                        <span class="hidden md:block font-medium text-gray-500">Hoàn tất</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('client.checkout.store', $tour) }}" method="POST" id="checkout-form" x-data="checkoutForm()">
                @csrf

                {{-- Honeypot --}}
                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="website_url" tabindex="-1" value="">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    {{-- Left Column - Forms --}}
                    <div class="lg:col-span-7 space-y-6">

                        {{-- Tour Summary Card (Mobile) --}}
                        <div class="lg:hidden tour-summary-card rounded-2xl p-5 border border-amber-200 shadow-sm">
                            <div class="flex gap-4">
                                <img src="{{ $tour->thumbnail ?? 'https://placehold.co/120x90' }}"
                                    alt="{{ $tour->name }}"
                                    class="w-24 h-20 object-cover rounded-xl flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-800 leading-tight line-clamp-2">{{ $tour->name }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <i class="fa-regular fa-clock mr-1"></i>{{ $tour->duration ?? 'N/A' }}
                                    </p>
                                    <p class="text-lg font-extrabold text-[var(--color-primary)] mt-1">
                                        {{ number_format($tour->price_adult ?? 0) }}đ
                                        <span class="text-xs font-normal text-gray-500">/người</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Error Messages --}}
                        @if (session('error'))
                            <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700 flex items-start gap-3">
                                <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                                <div class="flex items-center gap-2 font-semibold mb-2">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    Vui lòng kiểm tra lại thông tin
                                </div>
                                <ul class="list-disc list-inside space-y-1 ml-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Contact Information --}}
                        <div class="form-section bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                    <i class="fa-solid fa-user text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Thông tin liên hệ</h2>
                                    <p class="text-sm text-gray-500">Vui lòng điền đầy đủ thông tin</p>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fa-solid fa-user-tag text-gray-400 mr-1"></i>
                                        Họ và tên <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name" id="full_name"
                                        value="{{ old('full_name', $user->name ?? '') }}"
                                        placeholder="Nhập họ và tên đầy đủ"
                                        required
                                        class="block w-full px-4 py-3.5 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fa-solid fa-envelope text-gray-400 mr-1"></i>
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $user->email ?? '') }}"
                                            placeholder="email@example.com"
                                            required
                                            class="block w-full px-4 py-3.5 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fa-solid fa-phone text-gray-400 mr-1"></i>
                                            Số điện thoại <span class="text-red-500">*</span>
                                        </label>
                                        <input type="tel" name="phone" id="phone"
                                            value="{{ old('phone', $user->phone ?? '') }}"
                                            placeholder="0912 345 678"
                                            required
                                            class="block w-full px-4 py-3.5 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                                    </div>
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i>
                                        Địa chỉ
                                    </label>
                                    <input type="text" name="address" id="address"
                                        value="{{ old('address', $user->address ?? '') }}"
                                        placeholder="Số nhà, đường, quận/huyện, thành phố"
                                        class="block w-full px-4 py-3.5 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                                </div>

                                <div>
                                    <label for="note" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fa-solid fa-message text-gray-400 mr-1"></i>
                                        Ghi chú / Yêu cầu đặc biệt
                                    </label>
                                    <textarea name="note" id="note" rows="3"
                                        placeholder="Ví dụ: Có trẻ nhỏ đi cùng, cần ghế trẻ em..."
                                        class="block w-full px-4 py-3.5 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all bg-gray-50 focus:bg-white resize-none">{{ old('note') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="form-section bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                    <i class="fa-solid fa-credit-card text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Phương thức thanh toán</h2>
                                    <p class="text-sm text-gray-500">Chọn cách thanh toán phù hợp</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                {{-- Office Payment - Active --}}
                                <label for="payment_office"
                                    class="payment-option selected flex items-start p-5 rounded-2xl cursor-pointer group">
                                    <input type="radio" id="payment_office" name="payment_method" value="office"
                                        class="mt-1 h-5 w-5 text-[var(--color-primary)] border-gray-300 focus:ring-[var(--color-primary)]" checked>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-gray-800 text-lg">Thanh toán tại văn phòng</span>
                                            <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                                Khuyên dùng
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Quý khách đến văn phòng King Express Travel để hoàn tất thanh toán và nhận voucher tour.
                                        </p>
                                        <div class="mt-3 p-3 bg-amber-50 rounded-xl text-sm">
                                            <p class="font-semibold text-gray-800 mb-1">
                                                <i class="fa-solid fa-building text-[var(--color-primary)] mr-1"></i>
                                                Địa chỉ văn phòng:
                                            </p>
                                            <p class="text-gray-600">123 Đường ABC, Quận 1, TP. Hồ Chí Minh</p>
                                            <p class="text-gray-600 mt-1">
                                                <i class="fa-solid fa-clock text-gray-400 mr-1"></i>
                                                Giờ làm việc: 8:00 - 18:00 (T2 - T7)
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ml-3 w-14 h-14 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-building-columns text-[var(--color-primary)] text-2xl"></i>
                                    </div>
                                </label>

                                {{-- VNPAY - Disabled --}}
                                <div class="payment-option disabled flex items-start p-5 rounded-2xl relative overflow-hidden">
                                    <input type="radio" id="payment_vnpay" name="payment_method" value="vnpay"
                                        class="mt-1 h-5 w-5 text-gray-300 border-gray-300" disabled>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-gray-500 text-lg">Thanh toán qua VNPAY</span>
                                            <span class="px-2.5 py-1 bg-gray-200 text-gray-600 text-xs font-semibold rounded-full flex items-center gap-1">
                                                <i class="fa-solid fa-clock text-[10px]"></i>
                                                Đang phát triển
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-400 mt-1">
                                            Thanh toán an toàn qua cổng VNPAY (ATM, Visa, Master, QR Code).
                                        </p>
                                    </div>
                                    <div class="ml-3 w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                                        <img src="https://vnpay.vn/s1/statics.vnpay.vn/2023/6/0oxhzjmxbksr1686814746087.png"
                                            alt="VNPAY" class="h-8 opacity-40 grayscale">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Trust Badges --}}
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6">
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <div class="w-12 h-12 mx-auto rounded-full bg-white shadow-sm flex items-center justify-center mb-2">
                                        <i class="fa-solid fa-shield-halved text-green-500 text-xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-600">Bảo mật thông tin</p>
                                </div>
                                <div>
                                    <div class="w-12 h-12 mx-auto rounded-full bg-white shadow-sm flex items-center justify-center mb-2">
                                        <i class="fa-solid fa-headset text-blue-500 text-xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-600">Hỗ trợ 24/7</p>
                                </div>
                                <div>
                                    <div class="w-12 h-12 mx-auto rounded-full bg-white shadow-sm flex items-center justify-center mb-2">
                                        <i class="fa-solid fa-rotate-left text-purple-500 text-xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-600">Hoàn tiền dễ dàng</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column - Order Summary --}}
                    <div class="lg:col-span-5">
                        <div class="checkout-sidebar space-y-6">

                            {{-- Tour Information --}}
                            <div class="hidden lg:block tour-summary-card rounded-2xl p-6 border border-amber-200 shadow-sm">
                                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-suitcase-rolling text-[var(--color-primary)]"></i>
                                    Thông tin tour
                                </h2>

                                <div class="flex gap-4">
                                    <img src="{{ $tour->thumbnail ?? 'https://placehold.co/120x90' }}"
                                        alt="{{ $tour->name }}"
                                        class="w-28 h-24 object-cover rounded-xl flex-shrink-0 shadow-sm">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-gray-800 leading-tight line-clamp-2">{{ $tour->name }}</h3>
                                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                            <i class="fa-solid fa-hashtag"></i>
                                            {{ $tour->tour_code }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <i class="fa-regular fa-clock text-[var(--color-primary)] w-4"></i>
                                        <span>{{ $tour->duration ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <i class="fa-solid fa-plane-departure text-[var(--color-primary)] w-4"></i>
                                        <span>{{ $tour->departure_point ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-600 col-span-2">
                                        <i class="fa-solid fa-map-location-dot text-[var(--color-primary)] w-4"></i>
                                        <span class="truncate">{{ $tour->destinations->pluck('name')->join(', ') ?: 'N/A' }}</span>
                                    </div>
                                </div>

                                {{-- Departure Date --}}
                                <div class="mt-4 pt-4 border-t border-amber-200">
                                    <label for="departure_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fa-solid fa-calendar-days text-[var(--color-primary)] mr-1"></i>
                                        Ngày khởi hành <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="departure_date" id="departure_date"
                                        value="{{ old('departure_date', now()->addWeek()->format('Y-m-d')) }}"
                                        required
                                        class="block w-full px-4 py-3 border border-amber-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent bg-white">
                                </div>

                                @if($tour->remaining_slots)
                                    <div class="mt-3 flex items-center gap-2 text-sm">
                                        <span class="flex items-center gap-1 text-green-600">
                                            <i class="fa-solid fa-check-circle"></i>
                                            Còn {{ $tour->remaining_slots }} chỗ trống
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Passenger Quantity --}}
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                                <h2 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2">
                                    <i class="fa-solid fa-users text-[var(--color-primary)]"></i>
                                    Số lượng hành khách
                                </h2>

                                <div class="space-y-4" id="quantity-section">
                                    @php
                                        $passengerTypes = [
                                            'adult' => [
                                                'label' => 'Người lớn',
                                                'desc' => 'Từ 12 tuổi trở lên',
                                                'price' => $tour->price_adult ?? 0,
                                                'icon' => 'fa-user',
                                                'min' => 1
                                            ],
                                            'child' => [
                                                'label' => 'Trẻ em',
                                                'desc' => '5 - 11 tuổi',
                                                'price' => $tour->price_child ?? 0,
                                                'icon' => 'fa-child',
                                                'min' => 0
                                            ],
                                            'toddler' => [
                                                'label' => 'Trẻ nhỏ',
                                                'desc' => '2 - 4 tuổi',
                                                'price' => $tour->price_toddler ?? 0,
                                                'icon' => 'fa-baby',
                                                'min' => 0
                                            ],
                                            'infant' => [
                                                'label' => 'Em bé',
                                                'desc' => 'Dưới 2 tuổi',
                                                'price' => $tour->price_infant ?? 0,
                                                'icon' => 'fa-baby-carriage',
                                                'min' => 0
                                            ],
                                        ];
                                    @endphp

                                    @foreach($passengerTypes as $key => $type)
                                        @php
                                            $showType = $type['price'] > 0 || $key === 'adult';
                                        @endphp

                                        @if($showType)
                                            {{-- Visible passenger type with price --}}
                                            <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}"
                                                data-price="{{ $type['price'] }}"
                                                data-min="{{ $type['min'] }}">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                        <i class="fa-solid {{ $type['icon'] }} text-gray-500"></i>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-800">{{ $type['label'] }}</p>
                                                        <p class="text-xs text-gray-500">{{ $type['desc'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-4">
                                                    <p class="text-sm font-bold text-[var(--color-primary)] whitespace-nowrap">
                                                        {{ number_format($type['price']) }}đ
                                                    </p>
                                                    <div class="quantity-control">
                                                        <button type="button" class="quantity-btn minus-btn text-gray-500 hover:bg-[var(--color-primary)] hover:text-white"
                                                            {{ $key === 'adult' ? 'disabled' : '' }}>
                                                            <i class="fa-solid fa-minus text-xs"></i>
                                                        </button>
                                                        <input type="number" name="{{ $key }}_quantity"
                                                            value="{{ old($key.'_quantity', $key === 'adult' ? 1 : 0) }}"
                                                            min="{{ $type['min'] }}"
                                                            class="quantity-input"
                                                            readonly>
                                                        <button type="button" class="quantity-btn plus-btn text-gray-500 hover:bg-[var(--color-primary)] hover:text-white">
                                                            <i class="fa-solid fa-plus text-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Hidden input for types without price (ensures form submission includes all fields) --}}
                                            <input type="hidden" name="{{ $key }}_quantity" value="0">
                                        @endif
                                    @endforeach
                                </div>

                                {{-- Total Section --}}
                                <div class="mt-6 pt-4 border-t-2 border-dashed border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-gray-600">Tổng tiền</span>
                                            <p class="text-xs text-gray-400">Đã bao gồm thuế & phí</p>
                                        </div>
                                        <div id="total-price" class="text-3xl font-extrabold text-[var(--color-primary)]">
                                            0đ
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit Button --}}
                                <div class="mt-6">
                                    <button type="submit"
                                        class="submit-btn w-full bg-gradient-to-r from-[var(--color-primary)] to-orange-500 text-white font-bold py-4 px-6 rounded-xl hover:shadow-xl hover:shadow-amber-500/30 transition-all text-lg flex items-center justify-center gap-3">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        Hoàn tất đặt tour
                                    </button>
                                    <p class="text-center text-xs text-gray-500 mt-3">
                                        <i class="fa-solid fa-lock mr-1"></i>
                                        Thông tin của bạn được bảo mật tuyệt đối
                                    </p>
                                </div>
                            </div>

                            {{-- Need Help --}}
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-5 border border-blue-100">
                                <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-question text-blue-500"></i>
                                    Cần hỗ trợ?
                                </h4>
                                <p class="text-sm text-gray-600 mb-3">
                                    Liên hệ ngay với chúng tôi để được tư vấn miễn phí.
                                </p>
                                <a href="tel:19001234"
                                    class="flex items-center gap-3 bg-white rounded-xl p-3 shadow-sm hover:shadow-md transition-all">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fa-solid fa-phone text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">1900 1234</p>
                                        <p class="text-xs text-gray-500">Miễn phí cuộc gọi</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Mobile Sticky Footer --}}
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 z-40 shadow-2xl safe-area-bottom">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs text-gray-500">Tổng thanh toán</p>
                <p id="mobile-total-price" class="text-xl font-extrabold text-[var(--color-primary)]">0đ</p>
            </div>
            <button type="submit" form="checkout-form"
                class="flex-1 max-w-[200px] bg-gradient-to-r from-[var(--color-primary)] to-orange-500 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg flex items-center justify-center gap-2">
                <i class="fa-solid fa-check"></i>
                Đặt ngay
            </button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantitySection = document.getElementById('quantity-section');
            const totalPriceEl = document.getElementById('total-price');
            const mobileTotalPriceEl = document.getElementById('mobile-total-price');
            const departureDateInput = document.getElementById('departure_date');

            // Set minimum date to today
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            if (departureDateInput) {
                departureDateInput.min = `${yyyy}-${mm}-${dd}`;
            }

            // Format currency
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
            }

            // Calculate total
            function calculateTotal() {
                let total = 0;
                quantitySection.querySelectorAll('[data-price]').forEach(item => {
                    const price = parseFloat(item.dataset.price) || 0;
                    const quantity = parseInt(item.querySelector('.quantity-input').value) || 0;
                    total += price * quantity;
                });

                const formatted = formatCurrency(total);
                totalPriceEl.textContent = formatted;
                if (mobileTotalPriceEl) {
                    mobileTotalPriceEl.textContent = formatted;
                }

                // Add animation
                totalPriceEl.classList.remove('price-update');
                void totalPriceEl.offsetWidth; // Trigger reflow
                totalPriceEl.classList.add('price-update');
            }

            // Quantity button handlers
            quantitySection.addEventListener('click', function (e) {
                const btn = e.target.closest('.quantity-btn');
                if (!btn || btn.disabled) return;

                const container = btn.closest('[data-price]');
                const input = container.querySelector('.quantity-input');
                const minValue = parseInt(container.dataset.min) || 0;
                let value = parseInt(input.value) || 0;

                if (btn.classList.contains('plus-btn')) {
                    value++;
                } else if (btn.classList.contains('minus-btn')) {
                    value = Math.max(minValue, value - 1);
                }

                input.value = value;

                // Update minus button state
                const minusBtn = container.querySelector('.minus-btn');
                if (minusBtn) {
                    minusBtn.disabled = value <= minValue;
                }

                calculateTotal();
            });

            // Initialize
            calculateTotal();

            // Update minus button states on load
            quantitySection.querySelectorAll('[data-price]').forEach(item => {
                const input = item.querySelector('.quantity-input');
                const minusBtn = item.querySelector('.minus-btn');
                const minValue = parseInt(item.dataset.min) || 0;
                if (minusBtn && parseInt(input.value) <= minValue) {
                    minusBtn.disabled = true;
                }
            });
        });
    </script>
@endpush
