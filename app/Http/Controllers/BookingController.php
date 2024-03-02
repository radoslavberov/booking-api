<?php

namespace App\Http\Controllers;

use App\Exceptions\RoomUnavailableException;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;

class BookingController extends Controller
{
    private $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->bookingService->getBookings();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            $booking = $this->bookingService->create($request->validated());
            return BookingResource::make($booking);
        } catch (RoomUnavailableException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
