<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png'
        ];
    }

    /**
     * Gera mensagens de erro das validações
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'image.required' => 'A imagem de categoria é obrigatória',
            'image.mimes' => 'O arquivo deve ser uma imagem. Ex: PNG, JPEG.'
        ];
    }
}
