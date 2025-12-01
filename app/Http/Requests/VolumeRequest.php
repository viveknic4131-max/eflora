<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VolumeRequest extends FormRequest
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
        'volume_name'   => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
        'description'   => 'required|string|regex:/^[A-Za-z\s]+$/',
        'volume_type'   => 'required|in:0,1',
        'volume'        => 'required|regex:/^[A-Za-z0-9\s]+$/',
    ];
}

    public function messages(): array
{
    return [
        'volume_name.required' => 'Volume name is required.',
        'volume_name.string'   => 'Volume name must be a valid string.',
        'volume_name.regex'    => 'Volume name may contain only alphabets and spaces.',

        'description.required' => 'Description is required.',
        'description.regex'    => 'Description may contain only alphabets and spaces.',

        'volume_type.required' => 'Volume type is required.',
        'volume_type.in'       => 'Invalid volume type selected.',

        'volume.required'      => 'Volume field is required.',
        'volume.regex'         => 'Volume may contain only alphabets, numbers and spaces.',
    ];
}

}
