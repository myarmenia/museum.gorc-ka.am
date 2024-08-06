<?php

namespace App\Http\Requests\Turnstile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ActiveQrsRequest extends FormRequest
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
        'mac' => 'required',
        'local_ip' => 'required'
      ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
  }
}
