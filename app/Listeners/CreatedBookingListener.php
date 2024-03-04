<?php

namespace App\Listeners;

use App\Events\CreateBooking;
use App\Models\User;
use App\Notifications\BookingCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CreatedBookingListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateBooking $event)
    {
        $booking = $event->booking;

        $staffMembers = User::all();

        # Dispatch notification to all staff members
        foreach ($staffMembers as $staffMember) {
            $staffMember->notify(new BookingCreatedNotification($booking));
        }
    }
}
