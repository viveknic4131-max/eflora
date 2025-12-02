<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyRequest extends FormRequest
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
            'name'   => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
            'description'   => 'required|string|regex:/^[A-Za-z\s]+$/'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Family name is required.',
            'name.string'   => 'Family name must be a valid string.',
            'name.regex'    => 'Family name may contain only alphabets and spaces.',

            'description.required' => 'Family Description is required.',
            'description.string'   => 'Family Description name must be a valid string.',
            'description.regex'    => 'Family Description may contain only alphabets and spaces.',


        ];
    }
}
