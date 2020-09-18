<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_number' => 'required|digits:4',
            'name' => 'required|string',
            'rfc' => 'required|string|unique:clients|min:12|max:13',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|numeric'
        ];
    }
}
