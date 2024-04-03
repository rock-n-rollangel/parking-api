<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckRequest;
use App\Http\Resources\CheckResource;
use App\Models\Check;

class CheckController extends Controller
{
    public function index()
    {
        return CheckResource::collection(Check::all());
    }

    public function store(CheckRequest $request)
    {
        return new CheckResource(Check::create($request->validated()));
    }

    public function show(Check $check)
    {
        return new CheckResource($check);
    }

    public function update(CheckRequest $request, Check $check)
    {
        $check->update($request->validated());

        return new CheckResource($check);
    }

    public function destroy(Check $check)
    {
        $check->delete();

        return response()->json();
    }
}
