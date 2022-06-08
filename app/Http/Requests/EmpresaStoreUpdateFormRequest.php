<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EmpresaStoreUpdateFormRequest extends FormRequest
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
            'nome' => ['required'],
            'cnpj' => ['required'],
            'endereco' => ['required'],
            'numero' => ['required'],
            'bairro' => ['required'],
            'cep' => ['required'],
            'estado_id' => ['required', 'integer'],
            'municipio_id' => ['required', 'integer'],
            'certificado' => ['file'],

           // 'certificado' => ['mimes:pfx']
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome da empresa',
            'cnpj' => 'CNPJ',
            'estado_id' => 'UF',
            'municipio_id' => 'Municipio',
            'endereco' => 'Endereço',
            'bairro' => 'Bairro',
            'numero' => 'Número',
            'cep' => 'CEP',

        ];
    }
}
