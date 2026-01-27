<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientTourController extends Controller
{
    /**
     * Standardized price range presets for tour search.
     * Used across search bar, filter form, and quick filters.
     */
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

    public function index(Request $request): View|JsonResponse
    {
        $query = Tour::with(['destinations'])
            ->whereHas('categories', fn($q) => $q->where('is_active', true));

        // Extract and normalize filter parameters
        $filters = $this->extractFilters($request);

        // Apply search filter
        if ($filters['search']) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        // Apply category filter with descendants
        if ($filters['selectedCategory']) {
            $categoryIds = $filters['selectedCategory']->getAllDescendantIds();
            $categoryIds[] = $filters['selectedCategory']->id;
            $query->whereHas('categories', fn($q) => $q->whereIn('categories.id', $categoryIds));
        }

        // Apply destination filter
        if ($filters['destination']) {
            $query->whereHas('destinations', function ($q) use ($filters) {
                $q->where('slug', $filters['destination'])
                    ->orWhere('name', 'like', '%' . $filters['destination'] . '%');
            });
        }

        // Apply price range filter
        if ($filters['price_from'] !== null && $filters['price_from'] > 0) {
            $query->where('price_adult', '>=', $filters['price_from']);
        }
        if ($filters['price_to'] !== null && $filters['price_to'] > 0) {
            $query->where('price_adult', '<=', $filters['price_to']);
        }

        // Apply sorting
        match ($filters['sort']) {
            'price_asc' => $query->orderBy('price_adult', 'asc'),
            'price_desc' => $query->orderBy('price_adult', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'newest' => $query->orderByDesc('created_at'),
            default => null,
        };

        $tours = $query->orderBy('priority')->paginate(12)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('client.tours.partials.tour_list', compact('tours'))->render(),
                'next_page_url' => $tours->hasMorePages() ? $tours->nextPageUrl() : null,
                'total' => $tours->total(),
            ]);
        }

        $categories = Category::where('type', 'TOUR')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('priority')])
            ->orderBy('priority')
            ->get();

        $destinations = Destination::orderBy('name')->get();

        // Build active filters summary for UI
        $activeFilters = $this->buildActiveFiltersSummary($filters);

        return view('client.tours.index', [
            'tours' => $tours,
            'categories' => $categories,
            'destinations' => $destinations,
            'selectedCategorySlug' => $filters['category'],
            'selectedDestination' => $filters['destination'],
            'selectedCategory' => $filters['selectedCategory'],
            'filters' => $filters,
            'activeFilters' => $activeFilters,
            'pricePresets' => self::PRICE_PRESETS,
            'sortOptions' => self::SORT_OPTIONS,
            'priceSliderConfig' => [
                'min' => self::PRICE_SLIDER_MIN,
                'max' => self::PRICE_SLIDER_MAX,
                'step' => self::PRICE_SLIDER_STEP,
            ],
        ]);
    }

    /**
     * Extract and normalize all filter parameters from request.
     */
    private function extractFilters(Request $request): array
    {
        $categorySlug = $request->input('category');
        $destinationInput = $request->input('destination');
        $pricePreset = $request->input('price_preset');

        // Resolve destination to slug
        $destination = null;
        if ($destinationInput) {
            $destModel = Destination::where('slug', $destinationInput)
                ->orWhere('name', $destinationInput)
                ->first();
            $destination = $destModel?->slug ?? $destinationInput;
        }

        // Resolve category
        $selectedCategory = null;
        if ($categorySlug) {
            $selectedCategory = Category::where('slug', $categorySlug)->with('children')->first();
        }

        // Handle price - either from preset or direct values
        $priceFrom = null;
        $priceTo = null;

        if ($pricePreset && isset(self::PRICE_PRESETS[$pricePreset])) {
            $preset = self::PRICE_PRESETS[$pricePreset];
            $priceFrom = $preset['min'];
            $priceTo = $preset['max'];
        } else {
            $priceFrom = $request->filled('price_from') ? (int) $request->input('price_from') : null;
            $priceTo = $request->filled('price_to') ? (int) $request->input('price_to') : null;
        }

        return [
            'search' => $request->input('search'),
            'category' => $categorySlug,
            'selectedCategory' => $selectedCategory,
            'destination' => $destination,
            'price_preset' => $pricePreset,
            'price_from' => $priceFrom,
            'price_to' => $priceTo,
            'sort' => $request->input('sort', 'default'),
        ];
    }

    /**
     * Build human-readable active filters summary for display.
     */
    private function buildActiveFiltersSummary(array $filters): array
    {
        $active = [];

        if ($filters['search']) {
            $active[] = ['type' => 'search', 'label' => 'Tìm: ' . $filters['search'], 'param' => 'search'];
        }

        if ($filters['selectedCategory']) {
            $active[] = ['type' => 'category', 'label' => $filters['selectedCategory']->name, 'param' => 'category'];
        }

        if ($filters['destination']) {
            $dest = Destination::where('slug', $filters['destination'])->first();
            $active[] = ['type' => 'destination', 'label' => $dest?->name ?? $filters['destination'], 'param' => 'destination'];
        }

        if ($filters['price_preset'] && $filters['price_preset'] !== 'all') {
            $active[] = ['type' => 'price', 'label' => self::PRICE_PRESETS[$filters['price_preset']]['label'] ?? 'Giá tùy chọn', 'param' => 'price_preset'];
        } elseif ($filters['price_from'] || $filters['price_to']) {
            $label = $this->formatPriceRangeLabel($filters['price_from'], $filters['price_to']);
            $active[] = ['type' => 'price', 'label' => $label, 'param' => 'price'];
        }

        if ($filters['sort'] && $filters['sort'] !== 'default') {
            $active[] = ['type' => 'sort', 'label' => self::SORT_OPTIONS[$filters['sort']] ?? 'Sắp xếp', 'param' => 'sort'];
        }

        return $active;
    }

    private function formatPriceRangeLabel(?int $from, ?int $to): string
    {
        $fmt = fn($v) => number_format($v / 1000000, 0) . ' triệu';
        if ($from && $to) return $fmt($from) . ' - ' . $fmt($to);
        if ($from) return 'Từ ' . $fmt($from);
        if ($to) return 'Đến ' . $fmt($to);
        return 'Giá tùy chọn';
    }

    public function show(Tour $tour): View
    {
        $tour->load(['categories', 'destinations']);

        $relatedTours = Tour::with('destinations')
            ->where('id', '!=', $tour->id)
            ->whereHas('categories', function ($query) use ($tour) {
                $query->whereIn('id', $tour->categories->pluck('id'));
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return view('client.tours.show', compact('tour', 'relatedTours'));
    }

    public function getSearchSuggestions(Request $request): JsonResponse
    {
        $query = $request->input('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $tours = Tour::where('name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['name', 'slug', 'thumbnail']);

        $destinations = Destination::where('name', 'like', '%' . $query . '%')
            ->limit(3)
            ->get(['name', 'slug']);

        $results = [];

        foreach ($tours as $tour) {
            if ($tour) {
                $results[] = [
                    'name' => $tour->name,
                    'url' => route('client.tour.show', $tour->slug),
                    'type' => 'Tour',
                    'thumbnail' => $tour->thumbnail,
                ];
            }
        }

        foreach ($destinations as $destination) {
            if ($destination) {
                $results[] = [
                    'name' => $destination->name,
                    'url' => route('client.tours', ['destination' => $destination->slug]),
                    'type' => 'Điểm đến',
                    'thumbnail' => null,
                ];
            }
        }

        return response()->json($results);
    }

    public function getDestinationSuggestions(Request $request): JsonResponse
    {
        $query = $request->input('q');

        if (empty($query)) {
            return response()->json([]);
        }

        $destinations = Destination::where('name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['name', 'slug']);

        return response()->json($destinations);
    }
}
