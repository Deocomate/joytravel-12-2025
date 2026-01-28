<?php

namespace App\Services\Client;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingService
{
    public function createBooking(Tour $tour, array $data, ?int $userId = null): Order
    {
        $data['child_quantity'] = $data['child_quantity'] ?? 0;
        $data['toddler_quantity'] = $data['toddler_quantity'] ?? 0;
        $data['infant_quantity'] = $data['infant_quantity'] ?? 0;

        $remainingSlots = $tour->remaining_slots ?? 999;
        if (($data['adult_quantity'] + $data['child_quantity']) > $remainingSlots) {
            throw new \RuntimeException('Số lượng khách vượt quá số chỗ còn lại của tour.');
        }

        $totalPrice = ($data['adult_quantity'] * ($tour->price_adult ?? 0))
            + ($data['child_quantity'] * ($tour->price_child ?? 0))
            + ($data['toddler_quantity'] * ($tour->price_toddler ?? 0))
            + ($data['infant_quantity'] * ($tour->price_infant ?? 0));

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $userId,
                'tour_id' => $tour->id,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'] ?? null,
                'departure_date' => $data['departure_date'],
                'adult_quantity' => $data['adult_quantity'],
                'child_quantity' => $data['child_quantity'],
                'toddler_quantity' => $data['toddler_quantity'],
                'infant_quantity' => $data['infant_quantity'],
                'total_price' => $totalPrice,
                'note' => $data['note'] ?? null,
                'status' => 'PENDING',
            ]);

            Payment::create([
                'order_id' => $order->id,
                'method' => $this->getPaymentMethodText($data['payment_method']),
                'amount' => $totalPrice,
                'status' => 'PENDING',
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $this->sendConfirmationEmails($order);

        return $order;
    }

    private function getPaymentMethodText(string $paymentMethod): string
    {
        return $paymentMethod === 'vnpay' ? 'VNPAY' : 'Thanh toán tại văn phòng';
    }

    private function sendConfirmationEmails(Order $order): void
    {
        try {
            Mail::to($order->email)->send(new OrderConfirmationMail($order));

            $adminEmail = env('ADMIN_EMAIL_RECIPIENT');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new OrderConfirmationMail($order));
            }
        } catch (\Exception $e) {
            Log::error('Sending order confirmation email failed: ' . $e->getMessage());
        }
    }
}
