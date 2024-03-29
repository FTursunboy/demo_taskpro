<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'lastname' => ['required'],
            'surname' => ['required'],
            'phone' => ['required'],
            'login' => ['required'],
            'password' => [''],
            'telegram_id' => ['required'],
            'client_email' => [''],
            'project_id' => ['required'],
            'avatar' => [''],
        ];
    }
}
