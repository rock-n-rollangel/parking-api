<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Http\Resources\CheckResource;
use App\Models\Car;
use App\Models\ParkingSpace;
use Illuminate\Validation\ValidationException;

class CarController extends Controller
{
    public function index()
    {
        return CarResource::collection(Car::all());
    }

    public function store(CarRequest $request)
    {
        return new CarResource(Car::create($request->validated()));
    }

    public function show(Car $car)
    {
        return new CarResource($car);
    }

    public function update(CarRequest $request, Car $car)
    {
        $car->update($request->validated());

        return new CarResource($car);
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json();
    }

    public function park(Car $car, ParkingSpace $parkingSpace)
    {
        if (!$parkingSpace->state) {
            throw ValidationException::withMessages([
                'parking_space' => ['The parking space already occupied']
            ]);
        }

        $parkingSpace->update([ 'state' => false ]);
        $car->update([ 'parking_space_id' => $parkingSpace->id, 'entered_at' => now() ]);
    }

    public function leave(Car $car, ParkingSpace $parkingSpace)
    {
        if ($car->parking_space_id !== $parkingSpace->id) {
            throw ValidationException::withMessages([
                'parking_space' => ['The car is not on this parking space']
            ]);
        }

        if ($parkingSpace->state) {
            throw ValidationException::withMessages([
                'parking_space' => ['Parking space already freed']
            ]);
        }

        $parkingSpace->update([ 'state' => true ]);
        $car->update([ 'left_at' => now() ]);
    }

    public function check(Car $car)
    {
        $check = $car->check()->firstOrFail();
        return new CheckResource($check);
    }
}
