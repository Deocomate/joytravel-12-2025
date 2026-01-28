<?php

namespace App\Services\Admin;

use App\Models\News;
use App\Services\Common\SlugService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class NewsService
{
    public function __construct(private SlugService $slugService)
    {
    }

    public function getNews(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = News::with('category');

        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['date_range'])) {
            $dates = explode(' - ', $filters['date_range']);
            if (count($dates) === 2) {
                try {
                    $startDate = Carbon::createFromFormat('d/m/Y', $dates[0])->startOfDay();
                    $endDate = Carbon::createFromFormat('d/m/Y', $dates[1])->endOfDay();
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                } catch (\Exception) {
                }
            }
        }

        return $query->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function createNews(array $data): News
    {
        $data['slug'] = $this->slugService->generate($data['title'], News::class);
        return News::create($data);
    }

    public function updateNews(News $news, array $data): News
    {
        if (!empty($data['title']) && $data['title'] !== $news->title) {
            $data['slug'] = $this->slugService->generate($data['title'], News::class, $news->id);
        }

        $news->update($data);

        return $news;
    }
}
