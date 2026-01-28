<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;
use App\Services\Client\SearchService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientTourController extends Controller
{
    public function __construct(private SearchService $searchService)
    {
    }

    public function index(Request $request): View|JsonResponse
    {
        $filters = $this->searchService->extractFilters($request->all());
        $tours = $this->searchService->searchTours($filters);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('client.tours.partials.tour_list', compact('tours'))->render(),
                'next_page_url' => $tours->hasMorePages() ? $tours->nextPageUrl() : null,
                'total' => $tours->total(),
            ]);
        }

        $categories = $this->searchService->getCategories();
        $destinations = $this->searchService->getDestinations();
        $activeFilters = $this->searchService->buildActiveFiltersSummary($filters);

        return view('client.tours.index', [
            'tours' => $tours,
            'categories' => $categories,
            'destinations' => $destinations,
            'selectedCategorySlug' => $filters['category'],
            'selectedDestination' => $filters['destination'],
            'selectedCategory' => $filters['selectedCategory'],
            'filters' => $filters,
            'activeFilters' => $activeFilters,
            'pricePresets' => $this->searchService->getPricePresets(),
            'sortOptions' => $this->searchService->getSortOptions(),
            'priceSliderConfig' => $this->searchService->getPriceSliderConfig(),
        ]);
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
