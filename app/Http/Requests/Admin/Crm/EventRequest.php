<?php

namespace App\Http\Requests\Admin\Crm;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'themeEvent_id' => ['required'],
            'description' => ['required'],
            'date' => ['required'],
            'lead_id' => ['required'],
            'type_event_id' => ['required'],
            'event_status_id' => ['required'],
        ];
    }
}
