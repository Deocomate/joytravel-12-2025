<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Destination;
use App\Models\Order;
use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ClientBaseController extends Controller
{
    public function index(): View
    {
        // Hero banners from storage
        $banners = [
            '/userfiles/files/banners/chau-au-du-lich-viet.jpg',
            '/userfiles/files/banners/du-lich-bac-du-lich-viet.jpg',
            '/userfiles/files/banners/du-lich-chau-au-du-lich-viet(1).jpg',
        ];

        // Featured tours - top priority tours
        $featuredTours = Tour::orderBy('priority')
            ->with('destinations')
            ->limit(8)
            ->get();

        // Popular destinations - destinations with most tours, including thumbnail
        $popularDestinations = Destination::withCount('tours')
            ->having('tours_count', '>', 0)
            ->orderByDesc('tours_count')
            ->limit(6)
            ->get();

        // Tour categories with tours
        $tourCategories = Category::where('type', 'TOUR')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->whereHas('tours')
            ->with([
                'tours' => function ($query) {
                    $query->orderBy('priority')->limit(10);
                },
                'tours.destinations'
            ])
            ->orderBy('priority')
            ->limit(3)
            ->get();

        // News categories with news
        $newsCategories = Category::where('type', 'NEWS')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->whereHas('news')
            ->with([
                'news' => function ($query) {
                    $query->orderBy('priority')->limit(10);
                },
                'news.category'
            ])
            ->orderBy('priority')
            ->limit(2)
            ->get();

        // Statistics - cached for 1 hour
        $statistics = Cache::remember('homepage_statistics', 3600, function () {
            return [
                'total_tours' => Tour::count(),
                'total_destinations' => Destination::count(),
                'total_customers' => Order::where('status', 'completed')->count(),
                'years_experience' => now()->year - 2015,
            ];
        });

        // About us content
        $aboutUs = AboutUs::first();

        // Contact info
        $contactInfo = Contact::with('branches')->first();

        return view('client.pages.home', compact(
            'banners',
            'featuredTours',
            'popularDestinations',
            'tourCategories',
            'newsCategories',
            'statistics',
            'aboutUs',
            'contactInfo'
        ));
    }
}
