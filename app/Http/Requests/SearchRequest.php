<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'plant_type' => 'required|in:flora_india,checklist',
         'q' => 'required|string|min:1|max:255|regex:/^[A-Za-z\s]+$/',


            // 'page' => 'nullable|integer|min:1',
            // 'per_page' => 'nullable|integer|min:1|max:100'
        ];
    }

    public function messages(): array
    {

        return [
            'plant_type.required' => 'Please choose a search type.',
            'plant_type.in' => 'Invalid search type selected.',
            'q.required' => 'Please enter keyword for search.',
            'q.string' => 'Keyword must be a valid string.',
            'q.regex' => 'Only alphabets are allowed.',


        ];
    }

//     protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
// {
//     throw new \Illuminate\Http\Exceptions\HttpResponseException(
//         response()->json([
//             'errors' => $validator->errors()
//         ], 422)
//     );
// }
}
