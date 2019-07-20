<?php

namespace App\Http\Requests;

use App\Facades\Country;
use Illuminate\Validation\Rule;
use App\Rules\AlphaNumHyphenSpace;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name' => [
                'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'last_name' => [
                'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'street_address' => [
                'required', 'max:150', new AlphaNumHyphenSpace
            ],
            'postal_code' => [
                'required', 'max:16', new AlphaNumHyphenSpace
            ],
            'city' => [
                'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'country' => [
                'required', Rule::in(Country::codes())
            ],
            'phone' => [
                'required', 'phone:AUTO',
            ]
        ];
    }
}
