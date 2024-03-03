<?php

namespace App\Services;

use App\Exceptions\RoomUnavailableException;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function getBookings(): Collection
    {
        return Booking::all();
    }

    public function create(array $data): Booking
    {
        $room = Room::findOrFail($data['room_id']);
        $checkIn = Carbon::parse($data['check_in_date']);
        $checkOut = Carbon::parse($data['check_out_date']);

        # Check room availability
        if($this->checkRoomAvailability($room, $checkIn, $checkOut))
        throw new RoomUnavailableException();

        DB::beginTransaction();

        try {

            #Calculate total price of the reservation
            $totalPrice = $this->calculateTotalPrice($room, $checkIn, $checkOut);

            // Create the booking
            $booking = Booking::create([
                'room_id' => $data['room_id'],
                'customer_id' => $data['customer_id'],
                'check_in_date' => $data['check_in_date'],
                'check_out_date' => $data['check_out_date'],
                'total_price' => $totalPrice,
            ]);

            $this->createPayment($booking, $totalPrice);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }

        return $booking;
    }

    public function checkRoomAvailability(Room $room, Carbon $in, Carbon $out): bool
    {
        return Booking::where('room_id', $room->id)
            ->where(function ($query) use ($in, $out) {
                $query->where(function ($query) use ($in, $out) {
                    $query->whereBetween('check_in_date', [$in, $out])
                        ->orWhereBetween('check_out_date', [$in, $out]);
                })->orWhere(function ($query) use ($in, $out) {
                    $query->where('check_in_date', '<', $out)
                        ->where('check_out_date', '>', $in);
                })->orWhere(function ($query) use ($in, $out) {
                    $query->where('check_in_date', '<', $out)
                        ->where('check_out_date', '>', $out);
                });
            })->exists();
    }

    private function calculateTotalPrice(Room $room, Carbon $in, Carbon $out): int
    {
        $roomPrice = $room->price_per_night;

        $checkInDate = Carbon::parse($in);
        $checkOutDate = Carbon::parse($out);

        # Calculate duration of stay
        $durationOfStay = $checkInDate->diffInDays($checkOutDate);
        return $roomPrice * $durationOfStay;
    }

    public function createPayment(Booking $booking, int $totalPrice): Payment
    {
        return Payment::create([
            'booking_id' => $booking->id,
            'amount' => $totalPrice,
            'payment_date' => now(),
            'status' => 'pending',
        ]);
    }
}
