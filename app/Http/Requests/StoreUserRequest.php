<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => ['required', 'string'],
            'email' => ['required', 'unique:users','email'],
            'password' => ['required', 'string', 'min:8'],
            'contact_information' => ['exists:contact_information,id'],
            'gym_id' => ['exists:gyms,id']
        ];
    }
}
