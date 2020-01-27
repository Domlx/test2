<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonSearchRequest extends FormRequest
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
            'zip_code' => 'sometimes|string|max:10',
            'city' => 'sometimes|string',
        ];
    }
}
