<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: check if it auth
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
            'address'=>['string'],
            'phone_number'=>['string','max:15'],
            'facebook'=>['string'],
            'instagram'=>['string'],
            'twitter'=>['string'],
            'whatsapp'=>['string'],
            'website'=>['string']
        ];
    }
}
