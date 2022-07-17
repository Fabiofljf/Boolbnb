<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
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
            'title' => ['required', Rule::unique('apartments')->ignore($this->apartment), 'max:150'],
            'thumb' => 'required',
            'address' => 'required',
            'content' => 'nullable',
            'rooms' => 'integer|nullable',
            'beds' => 'integer|nullable',
            'baths' => 'integer|nullable',
            'sqm' => 'integer|nullable',
            'visibility' => 'nullable',
        ];
    }
}
