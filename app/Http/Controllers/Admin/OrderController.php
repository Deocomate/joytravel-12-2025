<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Admin\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function index(Request $request): View
    {
        $orders = $this->orderService->getOrders($request->all());

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'tour']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['PENDING', 'CONFIRMED', 'COMPLETED', 'CANCELLED'])],
        ]);

        $this->orderService->updateStatus($order, $validated['status']);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Xóa đơn hàng thành công.');
    }

    public function showPayment(Order $order): View
    {
        $order->load('payment', 'user', 'tour');
        return view('admin.orders.payment', compact('order'));
    }

    public function updatePayment(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['PENDING', 'SUCCESS', 'FAILED', 'CANCELLED', 'REFUNDED'])],
            'note' => ['nullable', 'string', 'max:2000'],
            'transaction_id' => ['nullable', 'string', 'max:2000'],
        ]);

        $this->orderService->updatePayment($order, $validated);

        return back()->with('success', 'Cập nhật thông tin thanh toán thành công.');
    }
}
