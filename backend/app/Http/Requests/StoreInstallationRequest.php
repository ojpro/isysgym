<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class StoreInstallationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return env('APP_INSTALLED') != true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'DB_HOST' => ['required', 'string'],
            'DB_PORT' => ['numeric', 'min:1024', 'max:65535'],
            'DB_DATABASE' => ['required', 'string'],
            'DB_USERNAME' => ['required', 'string'],
            'DB_PASSWORD' => ['string'],
        ];
    }

    /**
     * Define Error Messages
     */
    public function attributes()
    {
        return [
            'DB_HOST' => 'database url',
            'DB_PORT' => 'database port',
            'DB_DATABASE' => 'database name',
            'DB_USERNAME' => 'database username',
            'DB_PASSWORD' => 'database password'
        ];
    }
}
