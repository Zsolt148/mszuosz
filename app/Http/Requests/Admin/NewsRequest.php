<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'name' => ['required'],
            'slug' => ['required'],
            'type' => ['required'],
            'date' => ['required', 'date'],
            'is_visible' => ['nullable'],
            'tags' => ['nullable', 'array'],
            'body' => ['required'],
        ];
    }
}
