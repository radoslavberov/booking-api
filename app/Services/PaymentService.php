<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\Booking;
use App\Models\Payment;

class PaymentService
{

    public function create(Booking $booking): Payment
    {
        $vat = $booking->total_price * 0.20;
        return Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price + $vat,
            'payment_date' => now(),
            'status' => PaymentStatusEnum::Completed,
        ]);
    }
}
