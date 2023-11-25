<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'rooms' => ['numeric', 'nullable'],
            'bads' => ['numeric', 'nullable'],
            'square_meters' => ['numeric', 'nullable'],
            'bathrooms' => ['numeric', 'nullable'],
            'image' => ['image', 'nullable'],
            'visibility' => ['boolean'],
            'services' => ['exists:services,id', 'required'],
            'full_address' => ['required', 'string', 'max:255'],
        ];
    }
}
