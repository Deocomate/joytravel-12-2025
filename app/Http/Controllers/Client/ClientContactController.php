<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CustomerCare;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientContactController extends Controller
{
    public function index(): View
    {
        // Static data is now defined in the blade template
        return view('client.pages.contact.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_type' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'note' => 'nullable|string',
            'message' => 'required|string',
        ]);

        CustomerCare::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['service_type'],
            'message' => $validated['message'],
            'note' => $validated['note'],
        ]);

        return back()->with('success', 'Gửi liên hệ thành công! Chúng tôi sẽ phản hồi bạn sớm nhất có thể.');
    }
}
