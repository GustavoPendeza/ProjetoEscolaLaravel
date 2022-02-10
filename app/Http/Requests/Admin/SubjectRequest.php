<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'category_id' => 'required|numeric',
            'name' => 'required',
            'description' => 'required'
        ];
    }

    /**
     * Gera mensagens de erro das validações
     */
    public function messages()
    {
        return [
            'category_id.required' => 'O campo categoria é obrigatório',
            'category_id.numeric' => 'O campo categoria deve receber um ID',
            'name.required' => 'O campo nome é obrigatório',
            'description.required' => 'O campo descrição é obrigatório'
        ];
    }
}
