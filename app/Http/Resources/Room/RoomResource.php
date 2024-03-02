<?php

namespace App\Http\Resources\Room;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'number'        => $this->number,
            'type'          => $this->type,
            'pricePerNight' => $this->price_per_night,
            'status'        => $this->status,
            'createdAt'     => Carbon::parse($this->created_at)->format('d/m/y')
        ];
    }
}
