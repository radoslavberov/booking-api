<?php

namespace App\Http\Controllers;

use App\Exceptions\RoomUnavailableException;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Services\BookingService;
use App\Traits\PaginationTrait;

class BookingController extends Controller
{
    use PaginationTrait;
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
        $bookings = $this->bookingService->getBookings();

        $paginateBookings = $this->paginateCollection($bookings);

        return BookingCollection::make($paginateBookings);
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
            return response()->json([$e->getMessage()], $e->getCode());
        }
    }
}
