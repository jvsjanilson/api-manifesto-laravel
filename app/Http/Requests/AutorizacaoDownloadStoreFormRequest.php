<?php

namespace App\Http\Requests;

use App\Constantes\Limite;
use App\Models\ManifestoAutorizacao;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class AutorizacaoDownloadStoreFormRequest extends FormRequest
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
            'cpfcnpj' => ['required',
                function ($attribute, $value, $fail) {

                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoAutorizacao::where('cpfcnpj', $value)
                                ->where('manifesto_id', $this->request->get('manifesto_id') )
                                ->first();

                            if (isset($find)) {
                                $fail(':attribute ' . $value .' já lançado.');
                            }

                        }
                    }
                },

                function ($attribute, $value, $fail) {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $count = ManifestoAutorizacao::select(DB::raw('count(*) as total'))
                                ->where('manifesto_id', $this->request->get('manifesto_id'))
                                ->get()[0]['total'];
                            if ($count >= Limite::NUMERO_MAXIMO_AUTORIZACAO_DOWNLOAD)
                                $fail('Número máximo é ' . strval(Limite::NUMERO_MAXIMO_AUTORIZACAO_DOWNLOAD). '.');
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
            'cpfcnpj' => 'CPF/CNPJ'
        ];
    }
}
