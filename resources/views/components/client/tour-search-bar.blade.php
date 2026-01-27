@props(['variant' => 'overlay'])

@php
    use App\Http\Controllers\Client\ClientTourController;

    $isOverlay = $variant === 'overlay';
    $isHero = $variant === 'hero';
    $isMobile = $variant === 'mobile';

    // Unique ID suffix per variant to avoid duplicate IDs
    $idSuffix = $variant;

    // Wrapper classes
    if ($isHero) {
        $wrapperClasses = 'w-full hidden md:block';
    } elseif ($isOverlay) {
        $wrapperClasses =
            'hidden md:block absolute left-1/2 bottom-0 translate-y-1/2 -translate-x-1/2 w-full max-w-5xl px-4 z-20';
    } else {
        $wrapperClasses = 'block md:hidden w-full';
    }

    // Panel classes
    if ($isHero) {
        $panelClasses = 'search-panel-glass rounded-2xl p-4 md:p-5 transition-all duration-300';
    } elseif ($isOverlay) {
        $panelClasses = 'search-panel-glass rounded-2xl p-4 md:p-5 transition-all duration-300';
    } else {
        $panelClasses = 'search-panel-glass rounded-2xl p-4 mx-auto max-w-xl';
    }

    // Use standardized price presets from controller
    $pricePresets = ClientTourController::PRICE_PRESETS;
@endphp

<div class="{{ $wrapperClasses }}">
    <div class="{{ $panelClasses }}">
        <style>
            .search-panel-glass {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgba(255, 255, 255, 0.8);
                box-shadow: 0 20px 40px -4px rgba(0, 0, 0, 0.1), 0 8px 16px -4px rgba(0, 0, 0, 0.05);
                position: relative;
                z-index: 100;
                overflow: visible !important;
            }

            .search-input-shell {
                background: #f9fafb;
                border: 2px solid #e5e7eb;
                border-radius: 12px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .search-input-shell:hover {
                border-color: rgba(245, 158, 11, 0.5);
                background: #fff;
            }

            .search-input-shell:focus-within {
                border-color: var(--color-primary);
                background: #fff;
            }

            .search-input-icon {
                color: #9ca3af;
                transition: color 0.3s ease;
                pointer-events: none;
            }

            .search-input-shell:focus-within .search-input-icon {
                color: var(--color-primary);
            }

            .search-input-field {
                background: transparent !important;
            }

            .search-label {
                color: #374151;
                font-weight: 700;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
                gap: 0.375rem;
            }

            .search-label i {
                color: var(--color-primary);
            }

            .search-submit-btn {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
                position: relative;
                overflow: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .search-submit-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.6s ease;
                pointer-events: none;
            }

            .search-submit-btn:hover::before {
                left: 100%;
            }

            .search-submit-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px -5px rgba(245, 158, 11, 0.4);
            }

            /* Suggestions dropdown */
            .destination-suggestions-dropdown {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(229, 231, 235, 0.8);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
                z-index: 9999 !important;
                position: absolute !important;
            }

            .suggestion-item {
                transition: all 0.2s;
                cursor: pointer;
            }

            .suggestion-item:hover {
                background-color: var(--color-primary-subtle-hover);
                color: var(--color-primary-dark);
            }

            /* Custom select dropdown */
            .budget-dropdown {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(229, 231, 235, 0.8);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
                z-index: 9999 !important;
                position: absolute !important;
            }

            .budget-option {
                transition: all 0.2s;
                cursor: pointer;
            }

            .budget-option:hover {
                background-color: var(--color-primary-subtle-hover);
            }

            .budget-option.selected {
                background-color: var(--color-primary-light);
                color: var(--color-primary-dark);
                font-weight: 600;
            }

            @media (min-width: 768px) {
                .search-panel-glass:hover {
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
                }
            }
        </style>

        <div x-data="tourSearchComponent()" class="flex flex-col md:flex-row md:items-end gap-4">

            {{-- Destination Input --}}
            <div class="w-full md:flex-1 relative">
                <label class="search-label"><i class="fa-solid fa-location-dot text-primary"></i> Điểm đến</label>
                <div class="relative search-input-shell h-12 md:h-14">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input type="text" name="destination" x-model="query" @input.debounce.300ms="fetchDestinations"
                        @keydown.arrow-down.prevent="moveDown" @keydown.arrow-up.prevent="moveUp"
                        @keydown.enter.prevent="selectHighlight" placeholder="Bạn muốn đi đâu?"
                        class="w-full h-full pl-12 pr-4 bg-transparent border-none focus:ring-0 text-gray-800 font-medium rounded-xl"
                        autocomplete="off">

                    {{-- Suggestions Dropdown --}}
                    <div x-show="suggestions.length > 0" @click.outside="suggestions = []" style="display: none;"
                        class="absolute top-full left-0 w-full bg-white rounded-xl mt-2 z-50 shadow-xl border border-gray-100 max-h-60 overflow-y-auto">
                        <template x-for="(item, index) in suggestions" :key="index">
                            <div @click="selectItem(item)"
                                :class="{ 'bg-amber-50 text-primary-dark': activeIndex === index }"
                                class="px-4 py-3 cursor-pointer hover:bg-gray-50 flex items-center gap-2 transition-colors">
                                <i class="fa-solid fa-location-dot text-xs opacity-50"></i>
                                <span x-text="item.name"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Budget Select - Using standardized price_preset --}}
            <div class="w-full md:w-64" x-data="{
                open: false,
                selected: 'all',
                selectedLabel: '{{ $pricePresets['all']['label'] }}',
                selectOption(key, label) {
                    this.selected = key;
                    this.selectedLabel = label;
                    this.open = false;
                }
            }" @click.away="open = false">

                <label class="search-label">
                    <i class="fa-solid fa-sack-dollar"></i>
                    Ngân sách
                </label>

                <div class="relative">
                    <input type="hidden" name="price_preset" x-model="selected">

                    <button type="button" @click="open = !open"
                        class="search-input-shell w-full h-12 md:h-14 px-4 pl-12 flex items-center justify-between text-left">
                        <i class="fa-solid fa-wallet search-input-icon absolute left-4 top-1/2 -translate-y-1/2 text-lg"></i>
                        <span x-text="selectedLabel" class="text-gray-800 font-medium truncate"></span>
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <div x-show="open" style="display: none;"
                        class="budget-dropdown absolute top-full left-0 w-full rounded-xl mt-2 z-50 overflow-hidden py-1">
                        @foreach ($pricePresets as $key => $preset)
                            <div @click="selectOption('{{ $key }}', '{{ $preset['label'] }}')"
                                :class="{ 'selected': selected === '{{ $key }}' }"
                                class="budget-option px-4 py-3 flex items-center gap-3">
                                <i class="fa-solid fa-coins text-primary text-sm opacity-60"></i>
                                <span>{{ $preset['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="w-full md:w-auto">
                <button type="button" @click="submitSearch"
                    class="search-submit-btn w-full md:w-auto h-12 md:h-14 px-8 rounded-xl flex items-center justify-center gap-2 text-white font-bold text-lg">
                    <i class="fa-solid fa-search text-sm"></i>
                    <span>Tìm Ngay</span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tourSearchComponent', () => ({
                query: '',
                suggestions: [],
                activeIndex: -1,

                fetchDestinations() {
                    if (this.query.length < 1) {
                        this.suggestions = [];
                        return;
                    }
                    axios.get('{{ route('api.destination.suggestions') }}', {
                            params: {
                                q: this.query
                            }
                        })
                        .then(res => {
                            this.suggestions = res.data;
                            this.activeIndex = -1;
                        })
                        .catch(err => console.error(err));
                },

                moveDown() {
                    if (this.activeIndex < this.suggestions.length - 1) this.activeIndex++;
                },

                moveUp() {
                    if (this.activeIndex > 0) this.activeIndex--;
                },

                selectHighlight() {
                    if (this.activeIndex > -1 && this.suggestions[this.activeIndex]) {
                        this.selectItem(this.suggestions[this.activeIndex]);
                    }
                },

                selectItem(item) {
                    this.query = item.name;
                    this.suggestions = [];
                },

                submitSearch() {
                    const pricePreset = document.querySelector('input[name="price_preset"]')?.value || 'all';
                    const dest = this.query;
                    let url = '{{ route('client.tours') }}';
                    const params = new URLSearchParams();

                    if (dest) params.append('destination', dest);
                    if (pricePreset && pricePreset !== 'all') {
                        params.append('price_preset', pricePreset);
                    }

                    window.location.href = url + (params.toString() ? '?' + params.toString() : '');
                }
            }));
        });
    </script>
@endpush
