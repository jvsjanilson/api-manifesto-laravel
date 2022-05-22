<?php

namespace App\Http\Requests;

use App\Models\ManifestoCiot;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class CiotStoreFormRequest extends FormRequest
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
            'ciot' => ['required',
            function ($attribute, $value, $fail) {

                if ($value != "")
                {
                    if (!is_null($this->request->get('manifesto_id')))
                    {
                        $find = ManifestoCiot::where('ciot', $value)
                            ->where('manifesto_id', $this->request->get('manifesto_id') )
                            ->first();

                        if (isset($find)) {
                            $fail(':attribute ' . $value .' já lançado.');
                        }

                    }
                }
            }
            ],
            'cpfcnpj' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'manifesto_id' => 'ID do Manifesto',
            'cpfcnpj' => 'CPF/CNPJ',
            'ciot' => 'Numero Ciot'
        ];
    }
}
