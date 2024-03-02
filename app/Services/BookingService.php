<?php

namespace App\Services;

use App\Exceptions\RoomUnavailableException;
use App\Http\Resources\Booking\BookingCollection;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

class BookingService
{
    public function getBookings()
    {
        return BookingCollection::make(Booking::all());
    }

    public function create(array $data)
    {
        # Check room availability
        $this->checkRoomAvailability($data['room_id'], $data['check_in_date'], $data['check_out_date']);

        #Calculate total price of the reservation
        $totalPrice = $this->calculateTotalPrice($data['room_id'], $data['check_in_date'], $data['check_out_date']);

        // Create the booking
        return Booking::create([
            'room_id' => $data['room_id'],
            'customer_id' => $data['customer_id'],
            'check_in_date' =>  $data['check_in_date'],
            'check_out_date' => $data['check_out_date'],
            'total_price' => $totalPrice,
        ]);
    }

    private function checkRoomAvailability($roomId, $checkInDate, $checkOutDate)
    {
        $existingBookings = Booking::where('room_id', $roomId)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                        ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate]);
                })->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->where('check_in_date', '<', $checkInDate)
                        ->where('check_out_date', '>', $checkInDate);
                })->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->where('check_in_date', '<', $checkOutDate)
                        ->where('check_out_date', '>', $checkOutDate);
                });
            })->exists();

        if ($existingBookings) {
            throw new RoomUnavailableException();
        }
    }

    private function calculateTotalPrice($roomId, $checkIn, $checkOut)
    {

        $room = Room::findOrFail($roomId);
        $roomPrice = $room->price_per_night;

        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);

        # Calculate duration of stay
        $durationOfStay = $checkInDate->diffInDays($checkOutDate);

        return $roomPrice * $durationOfStay;
    }
}
