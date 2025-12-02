<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeciesRequest extends FormRequest
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
        'family_id'        => 'required|exists:families,id,deleted_at,NULL',
        'genus_id'         => 'required|exists:genera,id,deleted_at,NULL',

        'species'          => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
        'description'      => 'required|string|max:5000',

        'author'           => 'nullable|string|max:255|regex:/^[A-Za-z\s]+$/',
        'publication'      => 'nullable|string|max:255|regex:/^[A-Za-z\s]+$/',

        'year_described'   => 'nullable|digits:4|integer',

        'volume'           => 'nullable|string|max:255|regex:/^[A-Za-z\s]+$/',

        'page'             => 'nullable|numeric',

        'common_name'      => 'nullable|string|max:25|regex:/^[A-Za-z\s]+$/',

        'synonyms'         => 'nullable|array',
        'synonyms.*'       => 'nullable|string|max:255|regex:/^[A-Za-z\s]+$/',

        'images'           => 'nullable|array',
        'images.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ];
}


   public function messages(): array
{
    return [

        'family_id.required'   => 'Please select a family.',
        'family_id.exists'     => 'Selected family is invalid or deleted.',

        'genus_id.required'    => 'Please select a genus.',
        'genus_id.exists'      => 'Selected genus is invalid or deleted.',

        'species.required'     => 'Species name is required.',
        'species.regex'        => 'Species may only contain letters and spaces.',

        'description.required' => 'Description is required.',

        'author.regex'         => 'Author name may only contain letters and spaces.',
        'publication.regex'    => 'Publication name may only contain letters and spaces.',

        'year_described.digits'  => 'Year must be a 4-digit number (e.g., 2024).',
        'year_described.integer' => 'Year must be numeric.',

        'page.numeric'        => 'Page must be a numeric value.',

        'common_name.regex'   => 'Common name may only contain letters and spaces.',

        'synonyms.array'      => 'Synonyms must be a list.',
        'synonyms.*.string'   => 'Each synonym must be a valid string.',

        'images.array'        => 'Images must be an array.',
        'images.*.image'      => 'Each file must be an image.',
        'images.*.mimes'      => 'Images must be JPG, JPEG, PNG, or WEBP format.',
        'images.*.max'        => 'Each image must not exceed 2MB.',
    ];
}

}
