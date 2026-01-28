<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Services\Client\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClientCheckoutController extends Controller
{
    public function __construct(private BookingService $bookingService)
    {
    }

    public function index(Tour $tour): View
    {
        $user = Auth::user();
        $tour->load('destinations');
        return view('client.checkout.index', compact('tour', 'user'));
    }

    public function store(Request $request, Tour $tour): RedirectResponse
    {

        $loadTime = $request->input('form_load_time');
        $submitTime = now()->timestamp * 1000;

        if ($loadTime && ($submitTime - $loadTime) < 5000) {
            return back()->with('error', 'Yêu cầu của bạn được xử lý quá nhanh. Vui lòng thử lại.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:1000',
            'departure_date' => 'required|date|after_or_equal:today',
            'adult_quantity' => 'required|integer|min:1',
            'child_quantity' => 'nullable|integer|min:0',
            'toddler_quantity' => 'nullable|integer|min:0',
            'infant_quantity' => 'nullable|integer|min:0',
            'note' => 'nullable|string',
            'payment_method' => ['required', Rule::in(['office', 'vnpay'])],
            'website_url' => 'nullable|max:0',
        ]);

        try {
            $this->bookingService->createBooking($tour, $validated, Auth::id());
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Đã có lỗi xảy ra trong quá trình đặt tour. Vui lòng thử lại.');
        }

        if ($validated['payment_method'] === 'vnpay') {
            return redirect()->route('client.home')->with('success', 'Đặt tour thành công! Chức năng thanh toán VNPAY đang được phát triển.');
        }

        return redirect()->route('client.home')->with('success', 'Đặt tour thành công! Vui lòng kiểm tra email và đến văn phòng để hoàn tất thanh toán.');
    }
}
