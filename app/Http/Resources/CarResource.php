<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Car */
class CarResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'number' => $this->number,
            'entered_at' => $this->entered_at,
            'left_at' => $this->left_at,
            'parking_space_id' => $this->parking_space_id,
        ];
    }
}
