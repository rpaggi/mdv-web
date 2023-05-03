<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamEditRequest extends FormRequest
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
            "person.name" => ["required"],
            "person.age" => ["required"],
            "person.address" => ["required"],
            "person.city" => ["required"],
            "person.phone" => ["required"],
            "person.document" => ["nullable", "cpf"],
        ];
    }

    public function messages()
    {
        return [
            "person.document" => "Você deve informar um CPF válido."
        ];
    }
}
