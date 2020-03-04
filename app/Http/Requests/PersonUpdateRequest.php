<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonUpdateRequest extends FormRequest
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
            'first_name' => 'sometimes|string|max:255',
            'infix' => 'string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'street' => 'sometimes|string|max:255',
            'house_number' => 'sometimes|string|max:20',
            'zip_code' => 'sometimes|string|max:10',
            'city' => 'sometimes|string',
            'country' => 'sometimes|string',
        ];
    }
}
