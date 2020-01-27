<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonCreateRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'infix' => 'string|max:255',
            'last_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string',
            'country' => 'required|string',
            'requests.*.description' => 'sometimes|required|string',
        ];
    }

}
