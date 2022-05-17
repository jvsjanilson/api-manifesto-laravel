<?php

namespace App\Http\Requests;

use App\Models\Funcoes;
use App\Models\ManifestoContratante;
use Illuminate\Foundation\Http\FormRequest;

class ContratanteStoreFormRequest extends FormRequest
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
            'manifesto_id' => ['required','integer'],
            'cpfcnpj' => [
                'required',
                'min:14',
                'max:18',
                function ($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoContratante::
                                where('manifesto_id',$this->request->get('manifesto_id'))
                                ->where('cpfcnpj', Funcoes::disFormatCPFCNPJ($value))
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
            'cpfcnpj' => 'CPF/CNPJ',
        ];
    }
}
