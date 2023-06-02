<?php

namespace App\Http\Requests\Admin\Crm;

use Illuminate\Foundation\Http\FormRequest;

class LeadUpdateRequest extends FormRequest
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
            'fio' => 'required',
            'phone' => "required|unique:contacts,phone,{$this->lead->contact_id}",
            'address' => '',
            'email' => '',
            'source_id' => 'required',
            'state_id' => 'required',
            'status_id' => 'required',
            'description' => '',
            'is_client' => '',
        ];
    }
}
