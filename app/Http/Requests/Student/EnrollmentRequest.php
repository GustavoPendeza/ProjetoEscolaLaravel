<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
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
            'subject_id' => 'required|numeric'
        ];
    }

    /**
     * Gera mensagens de erro das validações
     */
    public function messages()
    {
        return [
            'subject_id.required' => 'O campo matéria é obrigatório',
            'subject_id.numeric' => 'O campo matéria deve receber um ID',
        ];
    }
}
