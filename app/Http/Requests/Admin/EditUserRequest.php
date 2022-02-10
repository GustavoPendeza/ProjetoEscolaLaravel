<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        $id = $this->request->get('user_id');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'access' => 'required|numeric'
        ];
    }

    /**
     * Gera mensagens de erro das validações
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'Digite um e-mail válido',
            'email.unique' => 'Esse e-mail já está sendo usado',
            'access.required' => 'O nível de acesso do usuário é obrigatório',
            'access.numeric' => 'O nível de acesso do usuário deve ser 0 ou 1'
        ];
    }
}
