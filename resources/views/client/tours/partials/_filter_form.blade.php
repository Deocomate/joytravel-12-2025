{{-- Filter Form Partial - Reusable for Desktop and Mobile --}}
@php
    $formId = $isMobile ?? false ? 'mobile-filter-form' : 'desktop-filter-form';
@endphp

<form action="{{ route('client.tours') }}" method="GET" id="{{ $formId }}">
    <div class="space-y-5">
        {{-- Search --}}
        <div>
            <label for="{{ $formId }}-search" class="block text-sm font-semibold text-gray-800 mb-1">
                <i class="fa-solid fa-magnifying-glass text-gray-400 mr-1"></i> Tên tour
            </label>
            <input type="text" name="search" id="{{ $formId }}-search" value="{{ request('search') }}"
                placeholder="Nhập tên tour..."
                class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all">
        </div>

        {{-- Category --}}
        <div>
            <label for="{{ $formId }}-category" class="block text-sm font-semibold text-gray-800 mb-1">
                <i class="fa-solid fa-folder text-gray-400 mr-1"></i> Loại hình
            </label>
            <select name="category" id="{{ $formId }}-category"
                class="block w-full px-4 py-2.5 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all">
                <option value="">Tất cả</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @selected($selectedCategorySlug == $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Destination --}}
        <div>
            <label for="{{ $formId }}-destination" class="block text-sm font-semibold text-gray-800 mb-1">
                <i class="fa-solid fa-map-marker-alt text-gray-400 mr-1"></i> Điểm đến
            </label>
            <select name="destination" id="{{ $formId }}-destination"
                class="block w-full px-4 py-2.5 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all">
                <option value="">Tất cả</option>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->slug }}" @selected($selectedDestination == $destination->slug)>{{ $destination->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Price Range --}}
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">
                <i class="fa-solid fa-money-bill-wave text-gray-400 mr-1"></i> Khoảng giá
            </label>
            <input type="text" class="price-range-slider" name="price_range" value="" />
            <input type="hidden" name="price_from" class="price-from" value="{{ request('price_from') }}">
            <input type="hidden" name="price_to" class="price-to" value="{{ request('price_to') }}">
        </div>

        {{-- Sort --}}
        <div>
            <label for="{{ $formId }}-sort" class="block text-sm font-semibold text-gray-800 mb-1">
                <i class="fa-solid fa-arrow-down-wide-short text-gray-400 mr-1"></i> Sắp xếp
            </label>
            <select name="sort" id="{{ $formId }}-sort"
                class="block w-full px-4 py-2.5 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all">
                <option value="default" @selected(request('sort') == 'default')>Mặc định</option>
                <option value="price_asc" @selected(request('sort') == 'price_asc')>Giá tăng dần</option>
                <option value="price_desc" @selected(request('sort') == 'price_desc')>Giá giảm dần</option>
                <option value="name_asc" @selected(request('sort') == 'name_asc')>Theo tên A-Z</option>
            </select>
        </div>

        {{-- Desktop Buttons --}}
        @if (!($isMobile ?? false))
            <div class="pt-3 grid grid-cols-2 gap-2">
                <a href="{{ route('client.tours') }}"
                    class="w-full text-center bg-gray-100 text-gray-700 font-semibold py-2.5 px-4 rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-eraser mr-2"></i> Xóa lọc
                </a>
                <button type="submit"
                    class="w-full text-center bg-[var(--color-primary)] text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-[var(--color-primary-dark)] transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-filter mr-2"></i> Lọc
                </button>
            </div>
        @endif
    </div>
</form>
