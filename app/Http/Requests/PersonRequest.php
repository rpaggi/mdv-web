<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            'name'=>['required', 'max:100'],
            'nickname' => ['required', 'max:30'],
            'document' => ['required', 'unique:people'],
            'address' => ['required', 'max:150'],
            'address_city_id' => ['required', 'exists:cities,id'],
            'address_reference' => ['required'],
            'phone' => ['required', 'max:11'],
            'age' => ['required', 'numeric'],
            'acs' => ['required', 'max:120']
        ];
    }
}
