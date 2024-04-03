<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\TimeHelper;

class TarifficationRequest extends FormRequest
{
    public function rules()
    {
        $regex = TimeHelper::regex;
        return [
            'active_from' => ['required', "regex:$regex"],
            'active_to' => ['required', "regex:$regex"],
            'price' => ['required', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
