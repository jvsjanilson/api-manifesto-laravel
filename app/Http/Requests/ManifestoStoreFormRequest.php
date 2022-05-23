<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManifestoStoreFormRequest extends FormRequest
{
    //protected $stopOnFirstFailure = true;
    // protected $redirect = '';
    // protected $redirectRoute = '';
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
            'ufini' => ['required','string','max:2'],
            'uffim' => ['required','string', 'max:2'],
            'tipoemit' => ['required','integer', Rule::in([1,2])],
            'tipotransp' => ['required','integer', Rule::in([0,1,2,3])],
            'modal' => ['required','integer', Rule::in([1,2,3,4])],
            'condutores' => ['required'],
            'municipios_carregamento'=> ['required'],

            'veiculo_tracao.vtracao_prop' => [Rule::in(0,1)],
            'veiculo_tracao.vtracao_placa' => ['required', 'regex:/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/'],
            'veiculo_tracao.vtracao_tara' => ['required', 'integer', 'min:1'],
            'veiculo_tracao.vtracao_tprod' => ['required', Rule::in([1,2,3,4,5,6])],
            'veiculo_tracao.vtracao_tpcar' => ['required', Rule::in([1,2,3,4,5])],
            'veiculo_tracao.vtracao_uf' => ['required', 'string', 'min:2', 'max:2'],
            'veiculo_tracao.vtracao_prop_nome' => ['required_if:veiculo_tracao.vtracao_prop,1','string'],
            'veiculo_tracao.vtracao_prop_cpfcnpj' => ['required_if:veiculo_tracao.vtracao_prop,1', 'string'],
            'veiculo_tracao.vtracao_prop_uf' => ['required_if:veiculo_tracao.vtracao_prop,1','string'],
            'veiculo_tracao.vtracao_prop_tpprop' => ['required_if:veiculo_tracao.vtracao_prop,1', Rule::in(0,1,2), 'integer'],

            'chave' => [
                'nullable',
                'max:44',
                'min:44',
                'required_unless:situacao,1'
            ],

            'cunid' => [
                'required',
                Rule::in(['01','02'])
            ],
        ];
    }

    public function attributes()
    {
        return [
            'ufini' => 'UF Inicio',
            'uffim' => 'UF Fim',
            'tipoemit' => 'Tipo Emitente',
            'tipotransp' => 'Tipo Transportador',
            'modal' => 'Modalidade',
            'condutores' => 'Condutor(es)',
            'cunid' => 'Codigo da Unidade',
            'chave' => 'Chave MDF-e',
            'veiculo_tracao.vtracao_placa' => 'Placa do veículo',
            'veiculo_tracao.vtracao_tara' => 'Tara do veículo',
            'veiculo_tracao.vtracao_tprod' => 'Tipo Rodado',
            'veiculo_tracao.vtracao_tpcar' => 'Tipo carroceria',
            'veiculo_tracao.vtracao_uf' => 'UF do proprietário',
            'veiculo_tracao.vtracao_prop_nome' => 'Nome do proprietário',
            'veiculo_tracao.vtracao_prop_cpfcnpj' => 'CPF/CNPJ do proprietário',
            'veiculo_tracao.vtracao_prop_uf' => 'UF do proprietário',
            'veiculo_tracao.vtracao_prop_tpprop' => 'Tipo proprietário',


        ];
    }
}
