<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'original_name' => ['nullable', 'string', 'max:191'],
            'short' => ['nullable', 'string', 'max:5'],
            'sa' => ['required', 'integer', Rule::unique('teams', 'sa')->ignore($this->team['id'] ?? null)],
            'address' => ['required', 'max:191'],
            'webpage' => ['nullable', 'max:191'],
            'contact_name' => ['nullable', 'max:191'],
            'contact_email' => ['nullable', 'email', 'max:191'],
        ];
    }
}
