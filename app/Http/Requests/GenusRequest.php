<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenusRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'genus'   => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
            'description'   => 'required|string|regex:/^[A-Za-z\s]+$/',
            'family_id' => 'required|exists:families,id,deleted_at,NULL',

        ];
    }

    public function messages(): array
    {
        return [
            'genus.required'      => 'Genus name is required.',
            'genus.string'        => 'Genus must be a valid string.',
            'genus.max'           => 'Genus may not be greater than 255 characters.',
            'genus.regex'         => 'Genus may contain only alphabets and spaces.',

            'description.required' => 'Description is required.',
            'description.string'   => 'Description must be a valid string.',
            'description.regex'    => 'Description may contain only alphabets and spaces.',

            'family_id.required' => 'Family is required.',
            'family_id.exists'   => 'Selected family does not exist or has been deleted.',
        ];
    }
}
