<?php

namespace App\Http\Requests;

use App\Constantes\Limite;
use App\Models\ManifestoCte;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CteStoreFormRequest extends FormRequest
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
            }),
            function($attribute, $value, $fail) {
                if ($value != "")
                {
                    if (!is_null($this->request->get('manifesto_id')))
                    {
                        $count = ManifestoCte::select(DB::raw('count(*) as total'))
                            ->where('manifesto_id', $this->request->get('manifesto_id'))
                            ->get()[0]['total'];

                        if ($count >= Limite::NUMERO_MAXIMO_CTE)
                        {
                            $fail('Número máximo é ' . strval(Limite::NUMERO_MAXIMO_CTE). '.');
                        }
                    }
                }
            }
            ],

            'municipio_id' => ['required', 'integer'],
            'chave' => [
                'required',
                'min:44',
                'max:44',
                function($attribute, $value, $fail) {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoCte::
                              where('manifesto_id', $this->request->get('manifesto_id'))
                            ->where('chave', $value)
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
            'municipio_id' => 'Municipio',
            'chave' => 'Chave CT-e',
        ];
    }
}
