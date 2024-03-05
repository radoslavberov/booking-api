<?php

namespace Database\Seeders;

use App\Enums\RoomTypesEnum;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'number' => '101',
                'type' => RoomTypesEnum::Single,
                'price_per_night' => 100.00,
                'status' => 'active'
            ],
            [
                'number' => '102',
                'type' => RoomTypesEnum::Double,
                'price_per_night' => 150.00,
                'status' => 'active'
            ],
            [
                'number' => '103',
                'type' => RoomTypesEnum::Triple,
                'price_per_night' => 200.00,
                'status' => 'active'
            ],
            [
                'number' => '104',
                'type' => RoomTypesEnum::Family,
                'price_per_night' => 250.00,
                'status' => 'active'
            ],
            [
                'number' => '105',
                'type' => RoomTypesEnum::Studio,
                'price_per_night' => 300.00,
                'status' => 'active'
            ],
        ];

        foreach ($rooms as $roomData) {
            Room::create($roomData);
        }
    }
}
