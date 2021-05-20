<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'name' => ['required'],
            'slug' => ['required'],
            'body' => ['nullable'],
            'email' => ['nullable', 'email'],
            'site' => ['nullable'],
            'category' => ['required'],
            'location_id' => ['nullable', 'integer'],
        ];
    }
}