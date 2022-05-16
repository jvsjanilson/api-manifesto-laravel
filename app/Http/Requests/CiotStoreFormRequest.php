<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CiotStoreFormRequest extends FormRequest
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
            'manifesto_id' => 'required',
            'ciot' => 'required',
            'cpfcnpj' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'manifesto_id' => 'ID do Manifesto',
            'cpfcnpj' => 'CPF/CNPJ',
            'ciot' => 'Numero Ciot'
        ];
    }
}
