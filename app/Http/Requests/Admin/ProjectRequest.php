<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:150'],
            'type_id' => ['required', 'exists:project_type_models,id'],
            'time' => ['required', 'gte:0'],
            'start' => ['required', 'date'],
            'finish' => ['required', 'date'],
            'types_id' => ['required'],
            'comment' => [''],
            'file' => [''],
            'file_name' => ['']
        ];

    }
}
