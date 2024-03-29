<?php

namespace App\Http\Requests\Corporative;

use Illuminate\Foundation\Http\FormRequest;

class CorporativeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|filled',
            'tin' => 'required|filled',
            'tickets_count' => 'required|numeric|min:100',
            'price' => 'required|filled|numeric',
            'email' => 'required|filled|email',
        ];
    }

    public function messages(): array
    {
        return [
            'name' => 'Անվանում դաշտը պարտադիր է',
            'tin' => "ՀՎՀՀ դաշտը պարտադիր է",
            'tickets_count.required' => "Տոմսերի քանակ դաշտը պարտադիր է",
            'tickets_count.numeric' => "Տոմսերի քանակ դաշտը պետք է պարունակի միայն թիվ",
            'tickets_count.min' => "Տոմսերի նվազագույն քանակը պետք է լինի 100",
            'price.required' => 'Գին դաշտը պարտադիր է',
            'price.numeric' => 'Գին դաշտը դաշտը պետք է պարունակի միայն թիվ',
            'email' => 'Էլփոստ դաշտը դաշտը պարտադիր է և պետք է լինի email տիպի',
        ];
    }
}
