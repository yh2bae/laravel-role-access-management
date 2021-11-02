<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name_id.required' => 'The Indonesia Service Name field is required.',
            'name_en.required' => 'The English Service Name field is required.'
        ];
    }
}
