@props(['variant' => 'overlay'])

@php
    $isOverlay = $variant === 'overlay';
    $isHero = $variant === 'hero';
    $isMobile = $variant === 'mobile';

    // Unique ID suffix per variant to avoid duplicate IDs
    $idSuffix = $variant;

    // Wrapper classes
    if ($isHero) {
        $wrapperClasses = 'w-full hidden md:block';
    } elseif ($isOverlay) {
        $wrapperClasses = 'hidden md:block absolute left-1/2 bottom-0 translate-y-1/2 -translate-x-1/2 w-full max-w-5xl px-4 z-20';
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

    // Budget options
    $budgetOptions = [
        '' => 'Tất cả mức giá',
        '0-5000000' => 'Dưới 5 triệu',
        '5000000-10000000' => '5 - 10 triệu',
        '10000000-20000000' => '10 - 20 triệu',
        '20000000-999999999' => 'Trên 20 triệu',
    ];
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
                isolation: isolate;
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

        <form id="tour-search-form-{{ $idSuffix }}" action="{{ route('client.tours') }}" method="GET"
            class="flex flex-col md:flex-row md:items-end gap-4" role="search" aria-label="Tìm tour">

            <!-- Destination with Alpine.js -->
            <div class="w-full md:flex-1" x-data="{
                    query: '',
                    suggestions: [],
                    showSuggestions: false,
                    loading: false,
                    selectedIndex: -1,
                    debounceTimer: null,

                    async fetchSuggestions() {
                        if (this.query.length < 2) {
                            this.suggestions = [];
                            this.showSuggestions = false;
                            return;
                        }

                        this.loading = true;
                        try {
                            const response = await fetch(`{{ route('api.destination.suggestions') }}?q=${encodeURIComponent(this.query)}`);
                            const data = await response.json();
                            this.suggestions = data.slice(0, 8);
                            this.showSuggestions = this.suggestions.length > 0;
                            this.selectedIndex = -1;
                        } catch (e) {
                            console.error('Failed to fetch suggestions:', e);
                        }
                        this.loading = false;
                    },

                    debouncedFetch() {
                        clearTimeout(this.debounceTimer);
                        this.debounceTimer = setTimeout(() => this.fetchSuggestions(), 300);
                    },

                    selectSuggestion(suggestion) {
                        this.query = suggestion.name || suggestion;
                        this.showSuggestions = false;
                    },

                    handleKeydown(e) {
                        if (!this.showSuggestions) return;

                        if (e.key === 'ArrowDown') {
                            e.preventDefault();
                            this.selectedIndex = Math.min(this.selectedIndex + 1, this.suggestions.length - 1);
                        } else if (e.key === 'ArrowUp') {
                            e.preventDefault();
                            this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
                        } else if (e.key === 'Enter' && this.selectedIndex >= 0) {
                            e.preventDefault();
                            this.selectSuggestion(this.suggestions[this.selectedIndex]);
                        } else if (e.key === 'Escape') {
                            this.showSuggestions = false;
                        }
                    }
                 }" @click.away="showSuggestions = false">

                <label for="destination-input-{{ $idSuffix }}" class="search-label">
                    <i class="fa-solid fa-location-dot"></i>
                    Điểm đến
                </label>

                <div class="relative search-input-shell h-12 md:h-14">
                    <i
                        class="fa-solid fa-magnifying-glass search-input-icon absolute left-4 top-1/2 -translate-y-1/2 text-lg"></i>

                    <input type="text" id="destination-input-{{ $idSuffix }}" name="destination" x-model="query"
                        @input="debouncedFetch()" @keydown="handleKeydown($event)"
                        @focus="if(suggestions.length > 0) showSuggestions = true" placeholder="Bạn muốn đi đâu?"
                        class="search-input-field w-full h-full pl-12 pr-4 border-none focus:ring-0 text-gray-800 placeholder-gray-400 text-base font-medium rounded-xl"
                        autocomplete="off">

                    <!-- Loading indicator -->
                    <div x-show="loading" class="absolute right-4 top-1/2 -translate-y-1/2">
                        <i class="fa-solid fa-spinner fa-spin text-gray-400"></i>
                    </div>

                    <!-- Suggestions dropdown -->
                    <div x-show="showSuggestions && suggestions.length > 0"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="destination-suggestions-dropdown absolute top-full left-0 w-full rounded-xl mt-2 z-50 overflow-hidden py-1 max-h-60 overflow-y-auto">
                        <template x-for="(suggestion, index) in suggestions" :key="index">
                            <div @click="selectSuggestion(suggestion)"
                                :class="{'bg-primary-subtle-hover': selectedIndex === index}"
                                class="suggestion-item px-4 py-3 flex items-center gap-3 hover:bg-gray-50">
                                <i class="fa-solid fa-location-dot text-primary text-sm"></i>
                                <span x-text="suggestion.name || suggestion" class="text-gray-700"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Budget with Custom Alpine Dropdown -->
            <div class="w-full md:w-64" x-data="{
                    open: false,
                    selected: '',
                    selectedLabel: 'Tất cả mức giá',
                    options: @js($budgetOptions),

                    selectOption(value, label) {
                        this.selected = value;
                        this.selectedLabel = label;
                        this.open = false;
                    }
                 }" @click.away="open = false">

                <label class="search-label">
                    <i class="fa-solid fa-sack-dollar"></i>
                    Ngân sách
                </label>

                <div class="relative">
                    <!-- Hidden input for form submission -->
                    <input type="hidden" name="budget" x-model="selected">

                    <!-- Custom select trigger -->
                    <button type="button" @click="open = !open"
                        class="search-input-shell w-full h-12 md:h-14 px-4 pl-12 flex items-center justify-between text-left">
                        <i
                            class="fa-solid fa-wallet search-input-icon absolute left-4 top-1/2 -translate-y-1/2 text-lg"></i>
                        <span x-text="selectedLabel" class="text-gray-800 font-medium truncate"></span>
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200"
                            :class="{'rotate-180': open}"></i>
                    </button>

                    <!-- Dropdown options -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="budget-dropdown absolute top-full left-0 w-full rounded-xl mt-2 z-50 overflow-hidden py-1">
                        @foreach($budgetOptions as $value => $label)
                            <div @click="selectOption('{{ $value }}', '{{ $label }}')"
                                :class="{'selected': selected === '{{ $value }}'}"
                                class="budget-option px-4 py-3 flex items-center gap-3">
                                <i class="fa-solid fa-coins text-primary text-sm opacity-60"></i>
                                <span>{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="w-full md:w-auto">
                <button type="submit"
                    class="search-submit-btn w-full md:w-auto h-12 md:h-14 px-8 rounded-xl flex items-center justify-center gap-2 text-white font-bold text-lg whitespace-nowrap">
                    <i class="fa-solid fa-search text-sm"></i>
                    <span>Tìm Ngay</span>
                </button>
            </div>
        </form>
    </div>
</div>