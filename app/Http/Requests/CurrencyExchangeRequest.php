<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyExchangeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'source' => 'required|string',
            'target' => 'required|string',
            'amount' => [
                'required',
                'regex:/^\d{1,3}(,\d{3})*(\.\d+)?$|^\d+(\.\d+)?$/'
            ]
        ];
    }
}
