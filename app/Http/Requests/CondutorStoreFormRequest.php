<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CondutorStoreFormRequest extends FormRequest
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
            'manifesto_id' => 'required|integer',
            'cpf' => ['required', 'max:14'],
            'nome' => ['required','string', 'max:60']
        ];
    }

    public function attributes()
    {
        return [
            'manifesto_id' => 'ID do Manifesto',
            'cpf' => 'CPF do condutor',
            'nome' => 'Nome do condutor'
        ];
    }
}
