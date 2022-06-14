<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMemberRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'gender' => ['string', Rule::in(['male', 'female', 'indeterminate', 'unknown'])],
            'weight' => ['numeric'],
            'birthday' => ['date'],
            'username' => ['string', 'unique:members'],
            'email' => ['email', 'unique:members'],
            'password' => ['string', 'min:8'],
            'avatar' => ['string']
        ];
    }
}
