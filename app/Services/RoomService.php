<?php

namespace App\Services;

use App\Http\Resources\Room\RoomCollection;
use App\Http\Resources\Room\RoomResource;
use App\Models\Room;

class RoomService
{
    public function getRooms()
    {
        $rooms = Room::all();

        return RoomCollection::make($rooms);
    }

    public function create(array $data)
    {
        return Room::create([
            'number'            => $data['number'],
            'type'              => $data['type'],
            'price_per_night'   => $data['price_per_night'],
            'status'            => $data['status'],
        ]);
    }

    public function getRoom(string $id)
    {
       return RoomResource::make(Room::findOrFail($id));
    }
}
