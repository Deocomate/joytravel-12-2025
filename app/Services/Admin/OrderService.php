<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class OrderService
{
    public function getOrders(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        $query = Order::with(['user', 'tour']);

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhereHas('tour', fn($subQuery) => $subQuery->where('name', 'like', '%' . $search . '%'));
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
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

        return $query->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function updateStatus(Order $order, string $status): Order
    {
        $order->update(['status' => $status]);
        return $order;
    }

    public function updatePayment(Order $order, array $data): Payment
    {
        $payment = $order->payment()->firstOrCreate(
            ['order_id' => $order->id],
            ['amount' => $order->total_price, 'method' => 'Chưa xác định']
        );

        $paymentData = [
            'status' => $data['status'],
            'note' => $data['note'] ?? null,
            'transaction_id' => $data['transaction_id'] ?? null,
        ];

        if ($data['status'] === 'SUCCESS' && $payment->status !== 'SUCCESS') {
            $paymentData['paid_at'] = now();
        }

        $payment->update($paymentData);

        return $payment;
    }
}
