<?php

namespace App\Http\Resources;

use App\Http\Resources\Booking\BookingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'booking'       => $this->whenLoaded('booking', new BookingResource($this->booking)),
            'amount'        => $this->amount,
            'paymentDate'   => $this->payment_date,
            'status'        => $this->status,
            'createdAt'     => $this->created_at,
        ];
    }
}
