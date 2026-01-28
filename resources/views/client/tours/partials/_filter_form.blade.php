{{-- Filter Form Partial - Reusable for Desktop and Mobile --}}
@php
    use App\Services\Client\SearchService;

    $formId = $isMobile ?? false ? 'mobile-filter-form' : 'desktop-filter-form';
    $pricePresets = $pricePresets ?? SearchService::PRICE_PRESETS;
    $sortOptions = $sortOptions ?? SearchService::SORT_OPTIONS;
    $sliderConfig = $priceSliderConfig ?? [
        'min' => SearchService::PRICE_SLIDER_MIN,
        'max' => SearchService::PRICE_SLIDER_MAX,
        'step' => SearchService::PRICE_SLIDER_STEP,
    ];

    $currentPricePreset = request('price_preset', '');
    $currentPriceFrom = request('price_from', $sliderConfig['min']);
    $currentPriceTo = request('price_to', $sliderConfig['max']);
    $useSlider = !$currentPricePreset && (request('price_from') || request('price_to'));
@endphp

<form action="{{ route('client.tours') }}" method="GET" id="{{ $formId }}" x-data="{
    priceMode: '{{ $useSlider ? 'slider' : 'preset' }}',
    selectedPreset: '{{ $currentPricePreset }}',
    togglePriceMode() {
        this.priceMode = this.priceMode === 'preset' ? 'slider' : 'preset';
        if (this.priceMode === 'preset') {
            this.selectedPreset = '';
        }
    }
}">
    <div class="space-y-5">
        {{-- Search --}}
        <div>
            <label for="{{ $formId }}-search" class="block text-sm font-semibold text-gray-800 mb-2">
                <i class="fa-solid fa-magnifying-glass text-[var(--color-primary)] mr-1"></i> Tên tour
            </label>
            <div class="relative">
                <input type="text" name="search" id="{{ $formId }}-search" value="{{ request('search') }}"
                    placeholder="Nhập tên tour bạn muốn tìm..."
                    class="block w-full px-4 py-3 pl-11 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        {{-- Category --}}
        <div>
            <label for="{{ $formId }}-category" class="block text-sm font-semibold text-gray-800 mb-2">
                <i class="fa-solid fa-folder text-[var(--color-primary)] mr-1"></i> Loại hình tour
            </label>
            <select name="category" id="{{ $formId }}-category"
                class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all focus:bg-white">
                <option value="">Tất cả loại hình</option>
                @foreach ($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        <option value="{{ $category->slug }}" @selected($selectedCategorySlug == $category->slug)>
                            {{ $category->name }}
                        </option>
                        @foreach ($category->children ?? [] as $child)
                            <option value="{{ $child->slug }}" @selected($selectedCategorySlug == $child->slug)>
                                └ {{ $child->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        {{-- Destination --}}
        <div>
            <label for="{{ $formId }}-destination" class="block text-sm font-semibold text-gray-800 mb-2">
                <i class="fa-solid fa-map-marker-alt text-[var(--color-primary)] mr-1"></i> Điểm đến
            </label>
            <select name="destination" id="{{ $formId }}-destination"
                class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all focus:bg-white">
                <option value="">Tất cả điểm đến</option>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->slug }}" @selected($selectedDestination == $destination->slug)>
                        {{ $destination->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Price Range Section --}}
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-sm font-semibold text-gray-800">
                    <i class="fa-solid fa-money-bill-wave text-[var(--color-primary)] mr-1"></i> Khoảng giá
                </label>
                <button type="button" @click="togglePriceMode()"
                    class="text-xs text-[var(--color-primary)] hover:underline font-medium">
                    <span x-show="priceMode === 'preset'">Tùy chỉnh</span>
                    <span x-show="priceMode === 'slider'">Chọn nhanh</span>
                </button>
            </div>

            {{-- Price Presets (Quick Select) --}}
            <div x-show="priceMode === 'preset'" class="space-y-2">
                @foreach ($pricePresets as $key => $preset)
                    @if ($key !== 'all')
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 cursor-pointer transition-all hover:border-[var(--color-primary)] hover:bg-amber-50/50"
                            :class="{ 'border-[var(--color-primary)] bg-amber-50': selectedPreset === '{{ $key }}' }">
                            <input type="radio" name="price_preset" value="{{ $key }}"
                                x-model="selectedPreset"
                                class="w-4 h-4 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                            <span class="text-sm font-medium text-gray-700">{{ $preset['label'] }}</span>
                        </label>
                    @endif
                @endforeach
                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 cursor-pointer transition-all hover:border-[var(--color-primary)] hover:bg-amber-50/50"
                    :class="{ 'border-[var(--color-primary)] bg-amber-50': selectedPreset === '' || selectedPreset === 'all' }">
                    <input type="radio" name="price_preset" value=""
                        x-model="selectedPreset"
                        class="w-4 h-4 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                    <span class="text-sm font-medium text-gray-700">Tất cả mức giá</span>
                </label>
            </div>

            {{-- Price Slider (Custom) --}}
            <div x-show="priceMode === 'slider'" style="display: none;">
                <input type="text" class="price-range-slider" name="price_range" value="" />
                <input type="hidden" name="price_from" class="price-from" value="{{ $currentPriceFrom }}">
                <input type="hidden" name="price_to" class="price-to" value="{{ $currentPriceTo }}">
                <div class="flex justify-between text-xs text-gray-500 mt-2">
                    <span>{{ number_format($sliderConfig['min']) }}đ</span>
                    <span>{{ number_format($sliderConfig['max']) }}đ</span>
                </div>
            </div>
        </div>

        {{-- Sort --}}
        <div>
            <label for="{{ $formId }}-sort" class="block text-sm font-semibold text-gray-800 mb-2">
                <i class="fa-solid fa-arrow-down-wide-short text-[var(--color-primary)] mr-1"></i> Sắp xếp theo
            </label>
            <select name="sort" id="{{ $formId }}-sort"
                class="block w-full px-4 py-3 border border-gray-200 bg-gray-50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all focus:bg-white">
                @foreach ($sortOptions as $value => $label)
                    <option value="{{ $value }}" @selected(request('sort', 'default') == $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Desktop Buttons --}}
        @if (!($isMobile ?? false))
            <div class="pt-4 space-y-3">
                <button type="submit"
                    class="w-full bg-[var(--color-primary)] text-white font-bold py-3 px-4 rounded-xl hover:bg-[var(--color-primary-dark)] transition-all flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20">
                    <i class="fa-solid fa-search"></i>
                    Tìm kiếm
                </button>
                <a href="{{ route('client.tours') }}"
                    class="w-full text-center bg-gray-100 text-gray-600 font-medium py-2.5 px-4 rounded-xl hover:bg-gray-200 transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-eraser text-sm"></i>
                    Xóa bộ lọc
                </a>
            </div>
        @endif
    </div>
</form>
