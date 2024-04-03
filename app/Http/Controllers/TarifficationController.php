<?php

namespace App\Http\Controllers;

use App\Helpers\TimeHelper;
use App\Http\Requests\TarifficationRequest;
use App\Http\Resources\TarifficationResource;
use App\Models\Tariffication;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class TarifficationController extends Controller
{
    /**
     * @throws Exception
     */
    private function haveTarifficationWithTimeSlice(TarifficationRequest $request)
    {
        $active_from = (new TimeHelper($request->active_from))->getDatabaseTime();
        $active_to = (new TimeHelper($request->active_to))->getDatabaseTime();

        $exists = Tariffication::where(function (Builder $query) use($active_from, $active_to) {
                    $query->where('active_from', '>=', $active_from)
                        ->where('active_to', '<=', $active_to);
                })
                ->exists();

        if ($exists) {
            $message = 'This time is reserved by another tariffication';
            throw ValidationException::withMessages([
                'active_from' => $message,
                'active_to' => $message,
            ]);
        }
    }

    public function index()
    {
        return TarifficationResource::collection(Tariffication::all());
    }

    /**
     * @throws Exception
     */
    public function store(TarifficationRequest $request)
    {
        // Throws exception if time slice is already allocated
        $this->haveTarifficationWithTimeSlice($request);
        return new TarifficationResource(Tariffication::create($request->validated()));
    }

    public function show(Tariffication $tariffication)
    {
        return new TarifficationResource($tariffication);
    }

    /**
     * @throws Exception
     */
    public function update(TarifficationRequest $request, Tariffication $tariffication)
    {
        // Throws exception if time slice is already allocated
        $this->haveTarifficationWithTimeSlice($request);
        $tariffication->update($request->validated());

        return new TarifficationResource($tariffication);
    }

    public function destroy(Tariffication $tariffication)
    {
        $tariffication->delete();

        return response()->json();
    }
}
