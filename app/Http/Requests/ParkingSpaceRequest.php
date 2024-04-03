<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParkingSpaceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'state' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
