<?php

namespace App\View\Components\Client;

use App\Models\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        // Lấy thông tin liên hệ riêng cho footer
        $contactInfo = Contact::with([
            'branches' => function ($query) {
                $query->orderBy('is_main', 'desc');
            }
        ])->first();

        return view('components.client.footer', compact('contactInfo'));
    }
}
