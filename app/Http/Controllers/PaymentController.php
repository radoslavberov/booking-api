<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Http\Resources\PaymentResource;
use App\Models\Booking;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(Booking $booking)
    {
        $payment = $this->paymentService->create($booking);

        return new PaymentResource($payment);
    }
}
