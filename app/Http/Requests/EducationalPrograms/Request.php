<?php

namespace App\Http\Requests\EducationalPrograms;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
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
        return  [

            'price'=> 'required|integer|gt:0',
            'max_quantity'=> 'required|integer|gt:0|min:' . request()->min_quantity,
            'min_quantity'=> 'required|integer|gt:0',
            'translate.*.name' => 'required',
            'translate.*.description' => 'required',

        ];

    }
}
