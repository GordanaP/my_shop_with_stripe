<?php

namespace App\Http\Requests;

use App\Facades\Country;
use Illuminate\Validation\Rule;
use App\Rules\AlphaNumHyphenSpace;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutAddressRequest extends FormRequest
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
            'billing.email' => [
                'sometimes', 'required', 'email', 'unique:users,email'
            ],
            'billing.first_name' => [
                'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'billing.last_name' => [
                'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'billing.street_address' => [
                'required', 'max:150', new AlphaNumHyphenSpace
            ],
            'billing.postal_code' => [
                'required', 'max:16', new AlphaNumHyphenSpace
            ],
            'billing.city' => [
                'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'billing.country' => [
                'required', Rule::in(Country::codes())
            ],
            'billing.phone' => [
                'required', 'phone:AUTO',
            ]
        ];
    }
}
