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
            'lastname' => [''],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required','min:6'],
            'surname' => ['required'],
            'position' => ['required'],
            'telegram_id' => ['required'],
            'birthday' => [''],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Введите имя',
            'login.required' => 'Введите имя',
            'login.unique' => 'Такой логин уже существует',
            'otdel_id.required' => 'Введите имя',
            'otdel_id.exists' => 'Такой отдел не существует',
            'phone.unique' => 'Такой телефон уже существует',
            'phone.required' => 'Введите имя',
            'password.required' => 'Введите имя',
            'password.min' => 'Пароль должен быть минимум 6 символов',
            'surname.required' => 'Введите имя',
            'position.required' => 'Введите имя',
            'telegram_id.required' => 'Введите имя',
            'telegram_id.unique' => 'Такой тереграмм ID уже существует',
        ];
    }
}
