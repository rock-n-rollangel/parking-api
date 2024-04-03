<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
{
    public function rules()
    {
        return [
            'car_id' => ['required', 'integer'],
            'amount' => ['required', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
