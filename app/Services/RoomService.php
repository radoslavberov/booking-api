<?php

namespace App\Services;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

class RoomService
{
    public function getRooms(): Collection
    {
        return Room::all();
    }

    public function create(array $data): Room
    {
        return Room::create([
            'number'            => $data['number'],
            'type'              => $data['type'],
            'price_per_night'   => $data['price_per_night'],
            'status'            => $data['status'],
        ]);
    }

    public function getRoom(string $roomId): Room
    {
        return Room::findOrfail($roomId);
    }
}
