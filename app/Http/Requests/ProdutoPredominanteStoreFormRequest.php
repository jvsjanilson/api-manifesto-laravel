<?php

namespace App\Http\Requests;

use App\Constantes\Limite;
use App\Models\ManifestoProdutoPredominante;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ProdutoPredominanteStoreFormRequest extends FormRequest
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
            'xprod' => ['required','string','max:120','min:2',
                function ($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoProdutoPredominante::
                                where('manifesto_id', $this->request->get('manifesto_id'))
                                ->where('xprod', $value)
                                ->first();

                            if (isset($find)) {
                                $fail(':attribute ' . $value .' já lançado.');

                            }

                            $count = ManifestoProdutoPredominante::select(DB::raw('count(*) as total'))
                                ->where('manifesto_id', $this->request->get('manifesto_id'))
                                ->get()[0]['total'];

                            if ($count >= Limite::NUMERO_MAXIMO_PRODUTOPREDOMINANTE)
                            {
                                $fail('Número máximo é ' . strval(Limite::NUMERO_MAXIMO_PRODUTOPREDOMINANTE). '.');
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
            'xprod' => 'Produto'

        ];
    }
}
