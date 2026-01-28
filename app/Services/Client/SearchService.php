<?php

namespace App\Services\Client;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{
    public const PRICE_PRESETS = [
        'all' => ['label' => 'Tất cả mức giá', 'min' => null, 'max' => null],
        'under5m' => ['label' => 'Dưới 5 triệu', 'min' => 0, 'max' => 5000000],
        '5m-10m' => ['label' => '5 - 10 triệu', 'min' => 5000000, 'max' => 10000000],
        '10m-20m' => ['label' => '10 - 20 triệu', 'min' => 10000000, 'max' => 20000000],
        'over20m' => ['label' => 'Trên 20 triệu', 'min' => 20000000, 'max' => null],
    ];

    public const SORT_OPTIONS = [
        'default' => 'Mặc định',
        'price_asc' => 'Giá tăng dần',
        'price_desc' => 'Giá giảm dần',
        'name_asc' => 'Theo tên A-Z',
        'newest' => 'Mới nhất',
    ];

    public const PRICE_SLIDER_MIN = 0;
    public const PRICE_SLIDER_MAX = 50000000;
    public const PRICE_SLIDER_STEP = 500000;

    public function extractFilters(array $input): array
    {
        $categorySlug = $input['category'] ?? null;
        $destinationInput = $input['destination'] ?? null;
        $pricePreset = $input['price_preset'] ?? null;

        $destination = $this->resolveDestinationSlug($destinationInput);

        $selectedCategory = null;
        if ($categorySlug) {
            $selectedCategory = Category::where('slug', $categorySlug)->with('children')->first();
        }

        [$priceFrom, $priceTo] = $this->resolvePriceRange($pricePreset, $input);

        return [
            'search' => $input['search'] ?? null,
            'category' => $categorySlug,
            'selectedCategory' => $selectedCategory,
            'destination' => $destination,
            'price_preset' => $pricePreset,
            'price_from' => $priceFrom,
            'price_to' => $priceTo,
            'sort' => $input['sort'] ?? 'default',
        ];
    }

    public function searchTours(array $filters, int $perPage = 12): LengthAwarePaginator
    {
        $query = Tour::with(['destinations'])
            ->whereHas('categories', fn($q) => $q->where('is_active', true));

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['selectedCategory'])) {
            $categoryIds = $filters['selectedCategory']->getAllDescendantIds();
            $categoryIds[] = $filters['selectedCategory']->id;
            $query->whereHas('categories', fn($q) => $q->whereIn('categories.id', $categoryIds));
        }

        if (!empty($filters['destination'])) {
            $destination = $filters['destination'];
            $query->whereHas('destinations', function ($q) use ($destination) {
                $q->where('slug', $destination)
                    ->orWhere('name', 'like', '%' . $destination . '%');
            });
        }

        if ($filters['price_from'] !== null && $filters['price_from'] > 0) {
            $query->where('price_adult', '>=', $filters['price_from']);
        }
        if ($filters['price_to'] !== null && $filters['price_to'] > 0) {
            $query->where('price_adult', '<=', $filters['price_to']);
        }

        match ($filters['sort']) {
            'price_asc' => $query->orderBy('price_adult', 'asc'),
            'price_desc' => $query->orderBy('price_adult', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'newest' => $query->orderByDesc('created_at'),
            default => null,
        };

        return $query->orderBy('priority')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getCategories()
    {
        return Category::where('type', 'TOUR')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('priority')])
            ->orderBy('priority')
            ->get();
    }

    public function getDestinations()
    {
        return Destination::orderBy('name')->get();
    }

    public function buildActiveFiltersSummary(array $filters): array
    {
        $active = [];

        if (!empty($filters['search'])) {
            $active[] = ['type' => 'search', 'label' => 'Tìm: ' . $filters['search'], 'param' => 'search'];
        }

        if (!empty($filters['selectedCategory'])) {
            $active[] = [
                'type' => 'category',
                'label' => $filters['selectedCategory']->name,
                'param' => 'category',
            ];
        }

        if (!empty($filters['destination'])) {
            $dest = Destination::where('slug', $filters['destination'])->first();
            $active[] = [
                'type' => 'destination',
                'label' => $dest?->name ?? $filters['destination'],
                'param' => 'destination',
            ];
        }

        if (!empty($filters['price_preset']) && $filters['price_preset'] !== 'all') {
            $active[] = [
                'type' => 'price',
                'label' => self::PRICE_PRESETS[$filters['price_preset']]['label'] ?? 'Giá tùy chọn',
                'param' => 'price_preset',
            ];
        } elseif ($filters['price_from'] || $filters['price_to']) {
            $label = $this->formatPriceRangeLabel($filters['price_from'], $filters['price_to']);
            $active[] = ['type' => 'price', 'label' => $label, 'param' => 'price'];
        }

        if (!empty($filters['sort']) && $filters['sort'] !== 'default') {
            $active[] = [
                'type' => 'sort',
                'label' => self::SORT_OPTIONS[$filters['sort']] ?? 'Sắp xếp',
                'param' => 'sort',
            ];
        }

        return $active;
    }

    public function getPricePresets(): array
    {
        return self::PRICE_PRESETS;
    }

    public function getSortOptions(): array
    {
        return self::SORT_OPTIONS;
    }

    public function getPriceSliderConfig(): array
    {
        return [
            'min' => self::PRICE_SLIDER_MIN,
            'max' => self::PRICE_SLIDER_MAX,
            'step' => self::PRICE_SLIDER_STEP,
        ];
    }

    private function resolveDestinationSlug(?string $destinationInput): ?string
    {
        if (!$destinationInput) {
            return null;
        }

        $destModel = Destination::where('slug', $destinationInput)
            ->orWhere('name', $destinationInput)
            ->first();

        return $destModel?->slug ?? $destinationInput;
    }

    private function resolvePriceRange(?string $pricePreset, array $input): array
    {
        if ($pricePreset && isset(self::PRICE_PRESETS[$pricePreset])) {
            $preset = self::PRICE_PRESETS[$pricePreset];
            return [$preset['min'], $preset['max']];
        }

        $priceFrom = isset($input['price_from']) ? (int) $input['price_from'] : null;
        $priceTo = isset($input['price_to']) ? (int) $input['price_to'] : null;

        return [$priceFrom, $priceTo];
    }

    private function formatPriceRangeLabel(?int $from, ?int $to): string
    {
        $fmt = fn($v) => number_format($v / 1000000, 0) . ' triệu';
        if ($from && $to) {
            return $fmt($from) . ' - ' . $fmt($to);
        }
        if ($from) {
            return 'Từ ' . $fmt($from);
        }
        if ($to) {
            return 'Đến ' . $fmt($to);
        }
        return 'Giá tùy chọn';
    }
}
