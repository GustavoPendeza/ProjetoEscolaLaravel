<?php

namespace App\Http\Requests\Student;

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
            'password' => 'nullable|min:8',
            'image' => 'mimes:jpeg,jpg,bmp,png'
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
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'image.mimes' => 'O arquivo deve ser uma imagem. Ex: PNG, JPEG.'
        ];
    }
}
