<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function rules()
    {
        return [
            'number' => ['required'],
            'entered_at' => ['sometimes', 'date_format:Y-m-d H:i'],
            'left_at' => ['sometimes', 'date_format:Y-m-d H:i'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
