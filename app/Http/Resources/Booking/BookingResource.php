<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Room\RoomResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'room'          => $this->whenLoaded('room', new RoomResource($this->room)),
            'customer'      => $this->whenLoaded('customer', new CustomerResource($this->customer)),
            'checkInDate'   => Carbon::parse($this->check_in_date)->format('d/m/y'),
            'checkOutDate'  => Carbon::parse($this->check_out_date)->format('d/m/y'),
            'totalPrice'    => $this->total_price,
            'createdAt'     => Carbon::parse($this->created_at)->format('d/m/y')
        ];
    }
}
