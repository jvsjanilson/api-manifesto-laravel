<?php

namespace App\Http\Requests;

use App\Constantes\Limite;
use App\Models\ManifestoCondutor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CondutorStoreFormRequest extends FormRequest
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
            'manifesto_id' => ['required','integer', 'min:1'],
            'nome' => ['required','string', 'max:60', 'min:4'],
            'cpf' => [
                'required',
                'max:14',
                'min:14',
                function ($attribute, $value, $fail) {

                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoCondutor::where('cpf', $value)
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
                            $count = ManifestoCondutor::select(DB::raw('count(*) as total'))
                                ->where('manifesto_id', $this->request->get('manifesto_id'))
                                ->get()[0]['total'];
                            if ($count >= Limite::NUMERO_MAXIMO_CONDUTOR)
                                $fail('Número máximo é ' . strval(Limite::NUMERO_MAXIMO_CONDUTOR). '.');
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
            'cpf' => 'CPF do condutor',
            'nome' => 'Nome do condutor'
        ];
    }
}
