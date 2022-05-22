<?php

namespace App\Http\Requests;

use App\Models\Funcoes;
use App\Models\ManifestoPedagio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PedagioStoreFormRequest extends FormRequest
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
            'manifesto_id' => ['integer', 'min:1', Rule::requiredIf(function(){
                return count($this->query->all()) == 0 ? true : false;
            })],
            'cnpj_fornecedor' => ['required'],
            'numero_comprovante' => ['required', 'integer',
                function ($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoPedagio::where('manifesto_id', $this->request->get('manifesto_id'))
                                ->where('cnpj_fornecedor', Funcoes::disFormatCPFCNPJ($this->request->get('cnpj_fornecedor')))
                                ->where('numero_comprovante', $this->request->get('numero_comprovante'))
                                ->first();

                            if (isset($find))
                            {
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
            'numero_comprovante' => 'Comprovante',
            'cnpj_fornecedor' => 'CNPJ Fornecedor',

        ];
    }
}
