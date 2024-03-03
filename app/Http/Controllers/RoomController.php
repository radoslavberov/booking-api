<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\Room\RoomCollection;
use App\Http\Resources\Room\RoomResource;
use App\Models\Room;
use App\Services\RoomService;
use App\Traits\PaginationTrait;

class RoomController extends Controller
{
    use PaginationTrait;
    private $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = $this->roomService->getRooms();

        $paginateRooms = $this->paginateCollection($rooms);

        return RoomCollection::make($paginateRooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {

        $room = $this->roomService->create($request->validated());

        return new RoomResource($room);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return RoomResource::make($this->roomService->getRoom($room->id));
    }
}
