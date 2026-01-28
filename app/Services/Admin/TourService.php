<?php

namespace App\Services\Admin;

use App\Models\Tour;
use App\Services\Common\SlugService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class TourService
{
    public function __construct(private SlugService $slugService)
    {
    }

    public function getTours(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = Tour::with(['categories', 'destinations']);

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('tour_code', 'like', '%' . $search . '%');
            });
        }

        if (!empty($filters['category_id'])) {
            $categoryId = $filters['category_id'];
            $query->whereHas('categories', fn($q) => $q->where('categories.id', $categoryId));
        }

        if (!empty($filters['destination_id'])) {
            $destinationId = $filters['destination_id'];
            $query->whereHas('destinations', fn($q) => $q->where('destinations.id', $destinationId));
        }

        if (!empty($filters['price_from'])) {
            $query->where('price_adult', '>=', $filters['price_from']);
        }

        if (!empty($filters['price_to'])) {
            $query->where('price_adult', '<=', $filters['price_to']);
        }

        return $query->orderByDesc('created_at')
            ->orderBy('priority')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function createTour(array $data): Tour
    {
        $data['slug'] = $this->slugService->generate($data['name'], Tour::class);

        $tourData = Arr::except($data, ['category_ids', 'destination_ids']);
        $tour = Tour::create($tourData);

        $this->syncRelations($tour, $data);

        return $tour;
    }

    public function updateTour(Tour $tour, array $data): Tour
    {
        if (!empty($data['name']) && $data['name'] !== $tour->name) {
            $data['slug'] = $this->slugService->generate($data['name'], Tour::class, $tour->id);
        }

        $tourData = Arr::except($data, ['category_ids', 'destination_ids']);
        $tour->update($tourData);

        $this->syncRelations($tour, $data);

        return $tour;
    }

    private function syncRelations(Tour $tour, array $data): void
    {
        $tour->categories()->sync($data['category_ids'] ?? []);

        if (array_key_exists('destination_ids', $data)) {
            $destinationsData = [];
            foreach ($data['destination_ids'] ?? [] as $index => $destinationId) {
                $destinationsData[$destinationId] = ['position' => $index + 1];
            }
            $tour->destinations()->sync($destinationsData);
        }
    }
}
