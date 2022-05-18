<?php

namespace App\Http\Requests;

use App\Models\Funcoes;
use App\Models\ManifestoSeguro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeguroStoreFormRequest extends FormRequest
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
            'manifesto_id' => ['required', 'integer', 'min:1'],
            'resp_seg' => ['required', Rule::in([1,2])],
            'cpfcnpj' => ['required_if:resp_seg,2','max:18'],
            'nome_seguradora' => ['required_if:resp_seg,2', 'max:30'],
            'cnpj_seguradora' => ['required_if:resp_seg,2', 'max:18'],
            'numero_apolice' => ['required_if:resp_seg,2', 'max:20',
                function ($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoSeguro::
                            where('manifesto_id', $this->request->get('manifesto_id'))
                            ->where('numero_apolice', $value)
                            ->where('cpfcnpj', Funcoes::disFormatCPFCNPJ($this->request->get('cpfcnpj')))
                            ->first();

                        if (isset($find)) {
                            $fail(':attribute ' . $value .' já lançado.');
                        }
                        }
                    }
                }
            ],
        ];
    }

    public function attributes()
    {
        return [
            'manifesto_id' => 'ID do Manifesto',
            'resp_seg' => 'Responsavel pelo seguro',
            'cpfcnpj' => 'CPF/CNPJ',
            'nome_seguradora' => 'Nome Seguradora',
            'cnpj_seguradora' => 'CNPJ Seguradora',
            'numero_apolice' => 'Numero da apolice',
            '' => '',
        ];
    }
}
