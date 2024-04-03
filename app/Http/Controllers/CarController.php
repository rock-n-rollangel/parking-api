<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;

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
}
