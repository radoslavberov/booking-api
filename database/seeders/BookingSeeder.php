<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve customers and rooms data
        $customers = Customer::all();
        $rooms = Room::all();

        // Create bookings using retrieved data
        foreach ($customers as $customer) {
            // Randomly select a room
            $room = $rooms->random();

            // Create a booking for the selected room and customer
            Booking::create([
                'room_id' => $room->id,
                'customer_id' => $customer->id,
                'check_in_date' => Carbon::now()->addDays(rand(1, 3)), // Random check-in date within the next 30 days
                'check_out_date' => Carbon::now()->addDays(rand(4, 7)), // Random check-out date 31 to 60 days from now
                'total_price' => $room->price_per_night * rand(1, 7), // Total price for a random duration of stay (1 to 7 days)
            ]);
        }
    }
}
