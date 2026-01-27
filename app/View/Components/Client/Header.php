<?php

namespace App\View\Components\Client;

use App\Models\Category;
use App\Models\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class Header extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        // Lấy thông tin liên hệ (có thể cache nếu cần)
        $contactInfo = Contact::with(['branches' => function ($query) {
            $query->orderBy('is_main', 'desc');
        }])->first();

        // Lấy danh mục tour cho menu (Logic cũ từ HeaderComposer)
        $tourCategoriesForMenu = Category::query()
            ->where('type', 'TOUR')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->with([
                'children' => function ($query) {
                    $query->where('is_active', true)->orderBy('priority');
                },
                'tours' => function ($query) {
                    $query->select('tours.id', 'tours.name', 'tours.slug', 'tours.thumbnail', 'tours.price_adult', 'tours.duration')
                        ->orderBy('tours.priority')
                        ->limit(4);
                }
            ])
            ->orderBy('priority')
            ->get();

        return view('components.client.header', compact('contactInfo', 'tourCategoriesForMenu'));
    }
}
