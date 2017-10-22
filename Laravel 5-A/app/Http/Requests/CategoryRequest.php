<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
           'name' => 'required | min:3'
        ];
    }
    public function messages()
    {
      return [
         'name.required' => 'Nome é obrigatório',
         'name.min' => 'Nome Precisa ter 3 caracteres'
      ];
   }

}
