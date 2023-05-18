<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class WokerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'login' => ['required', 'unique:users,login'],
            'lastname' => ['required'],
            'phone' => ['required', 'unique:users,phone'],
            'email' => ['required'],
            'password' => ['required','min:6'],
        ];
    }
}
