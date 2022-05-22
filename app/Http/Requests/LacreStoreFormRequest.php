<?php

namespace App\Http\Requests;

use App\Models\ManifestoLacre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LacreStoreFormRequest extends FormRequest
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
                //dd($this->method() == 'GET');
                return (count($this->query->all()) == 0) && ($this->method() == 'POST') ? true : false;
            })],
            'numero' => ['required', 'max:60',
                function ($attribute, $value, $fail) {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoLacre::
                                where('manifesto_id', $this->request->get('manifesto_id'))
                                ->where('numero', $value)
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
            'numero' => 'Número',
        ];
    }
}
