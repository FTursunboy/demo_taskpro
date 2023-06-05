<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'surname' => ['required'],
            'lastname' => [''],
            'phone' => ['required'],
            'otdel_id' => ['required'],
            'password' => [''],
            'position' => ['required'],
            'telegram_id' => ['required'],
            'avatar' => [''],
        ];
    }
}
