<?php

namespace App\Http\Requests;

use App\Constantes\Limite;
use App\Models\ManifestoReboque;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReboqueStoreFormRequest extends FormRequest
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
                return (count($this->query->all()) == 0) && ($this->method() == 'POST') ? true : false;
            })],
            'reboque_prop' => ['required','integer', Rule::in([0,1])],
            'reboque_tara' => ['required','integer', 'min:1'],
            'reboque_capkg' => ['required','integer', 'min:1'],
            'reboque_prop_nome' => ['required_if:reboque_prop,1', 'max:60'],
            'reboque_prop_cpfcnpj' => ['required_if:reboque_prop,1', 'max:18'],
            'reboque_prop_uf' => ['required_if:reboque_prop,1', 'max:2'],
            'reboque_prop_tpprop' => ['required_if:reboque_prop,1', 'integer', Rule::in([0,1,2])],
            'reboque_placa' => ['required', 'regex:/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/',
                function($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {

                            $find = ManifestoReboque::where('manifesto_id', $this->request->get('manifesto_id'))
                                ->where('reboque_placa', $value)
                                ->first();

                            if (isset($find)) {
                                $fail(':attribute ' . $value .' já lançado.');
                            }

                            $count = ManifestoReboque::select(DB::raw('count(*) as total'))
                                ->where('manifesto_id', $this->request->get('manifesto_id'))
                                ->get()[0]['total'];

                            if ($count >= Limite::NUMERO_MAXIMO_REBOQUE)
                            {
                                $fail('Número máximo é ' . strval(Limite::NUMERO_MAXIMO_REBOQUE). '.');
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
            'reboque_prop' => 'Proprietário do reboque',
            'reboque_tara' => 'Tara do veiculo',
            'reboque_capkg' => 'Capcidade em Kg',
            'reboque_prop_nome' => 'Nome do proprietário',
            'reboque_prop_cpfcnpj' => 'CPF/CNPJ do proprietário',
            'reboque_prop_uf' => 'UF',
            'reboque_prop_tpprop' => 'Tipo Proprietário',
            'reboque_placa' => 'Placa do reboque',

        ];
    }
}
