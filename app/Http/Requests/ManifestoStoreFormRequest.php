<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManifestoStoreFormRequest extends FormRequest
{
    //protected $stopOnFirstFailure = true;
    // protected $redirect = '';
    // protected $redirectRoute = '';
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
            'ufini' => ['required','string','max:2'],
            'uffim' => ['required','string', 'max:2'],
            'tipoemit' => ['required','integer', Rule::in([1,2])],
            'tipotransp' => ['required','integer', Rule::in([0,1,2,3])],
            'modal' => ['required','integer', Rule::in([1,2,3,4])],
            'condutores' => ['required'],
            // 'contratantes' => [
            //     function($attribute, $value, $fail) {
            //        if (isset($value))
            //        {
            //            foreach ($value as $v) {
            //                if (is_null($v['cpfcnpj'])) {
            //                    $fail('Informe o CPF/CNPJ do contratante');
            //                }
            //            }
            //        }
            //     }
            // ],
            'chave' => [
                'nullable',
                'max:44',
                'min:44',
                'required_unless:situacao,1'
            ],

            'cunid' => [
                'required',
                Rule::in(['01','02'])
            ],
        ];
    }

    public function attributes()
    {
        return [
            'ufini' => 'UF Inicio',
            'uffim' => 'UF Fim',
            'tipoemit' => 'Tipo Emitente',
            'tipotransp' => 'Tipo Transportador',
            'modal' => 'Modalidade',
            'condutores' => 'Condutor(es)',
            'cunid' => 'Codigo da Unidade',
            'chave' => 'Chave MDF-e'
        ];
    }
}
