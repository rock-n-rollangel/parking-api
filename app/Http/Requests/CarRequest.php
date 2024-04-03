<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function rules()
    {
        return [
            'number' => ['required'],
            'entered_at' => ['required_without:left_at', 'date'],
            'left_at' => ['required_without:entered_at', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
