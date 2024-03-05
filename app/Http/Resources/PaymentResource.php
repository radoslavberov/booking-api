<?php

namespace App\Http\Resources;

use App\Http\Resources\Booking\BookingResource;
use Carbon\Carbon;
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
            'paymentDate'   => Carbon::parse($this->payment_date)->format('d/m/y'),
            'status'        => $this->status,
            'createdAt'     => Carbon::parse($this->created_at)->format('d/m/y'),
        ];
    }
}
