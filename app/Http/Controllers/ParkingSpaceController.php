<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingSpaceRequest;
use App\Http\Resources\ParkingSpaceResource;
use App\Models\Car;
use App\Models\ParkingSpace;

class ParkingSpaceController extends Controller
{
    public function index()
    {
        return ParkingSpaceResource::collection(ParkingSpace::all());
    }

    public function store(ParkingSpaceRequest $request)
    {
        return new ParkingSpaceResource(ParkingSpace::create($request->validated()));
    }

    public function show(ParkingSpace $parkingSpace)
    {
        return new ParkingSpaceResource($parkingSpace);
    }

    public function update(ParkingSpaceRequest $request, ParkingSpace $parkingSpace)
    {
        $parkingSpace->update($request->validated());

        return new ParkingSpaceResource($parkingSpace);
    }

    public function destroy(ParkingSpace $parkingSpace)
    {
        $parkingSpace->delete();

        return response()->json();
    }

    public function freeSpaces()
    {
        return ParkingSpaceResource::collection(ParkingSpace::whereState(true));
    }
}
