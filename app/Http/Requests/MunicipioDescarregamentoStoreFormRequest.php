<?php

namespace App\Http\Requests;

use App\Constantes\Limite;
use App\Models\ManifestoMunicipioDescarregamento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MunicipioDescarregamentoStoreFormRequest extends FormRequest
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
            'estado_id' => ['required','integer', 'min:1'],
            'municipio_id' => ['required','integer', 'min:1',
                function ($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoMunicipioDescarregamento::where('manifesto_id', $this->request->get('manifesto_id'))
                                ->where('estado_id', $this->request->get('estado_id'))
                                ->where('municipio_id', $value)
                                ->first();

                            if (isset($find)) {
                                $fail(':attribute ' . $value .' já lançado.');
                            }

                            $count = ManifestoMunicipioDescarregamento::select(DB::raw('count(*) as total'))
                                ->where('manifesto_id', $this->request->get('manifesto_id'))
                                ->get()[0]['total'];

                            if ($count >= Limite::NUMERO_MAXIMO_MUNICIPIO_DESCARREGAMENTO)
                            {
                                $fail('Número máximo é ' . strval(Limite::NUMERO_MAXIMO_MUNICIPIO_DESCARREGAMENTO) . '.');
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
            'estado_id' => 'Estado',
            'municipio_id' => 'Municipio',
        ];
    }
}
