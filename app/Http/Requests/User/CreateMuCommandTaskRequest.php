<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateMuCommandTaskRequest extends FormRequest
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
            'time' => ['required'],
            'type_id' => ['required', 'exists:task_type_models,id'],
            'from' => ['required'],
            'to' => ['required'],
            'file' => [''],
            'file_name' => [''],
            'comment' => [''],
            'author_id' => [''],
            'project_id' => ['required', 'exists:project_models,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
