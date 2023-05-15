<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'otdel_id' => ['required', 'exists:otdels_models,id'],
            'lastname' => ['required'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required','min:6'],
            'surname' => ['required'],
            'position' => ['required'],
            'telegram_id' => ['required'],
        ];
    }
}
