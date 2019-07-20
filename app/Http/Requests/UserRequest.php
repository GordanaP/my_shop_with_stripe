<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumSpace;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => [
                'required','max:255', 'alpha_num',
            ],
            'email' => [
                'required','email','max:255',
                Rule::unique('users')->ignore($this->user->id)
            ],
            'password' => [
                'nullable', 'min:6', 'confirmed'
            ],
        ];
    }
}
