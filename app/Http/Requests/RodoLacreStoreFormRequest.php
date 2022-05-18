<?php

namespace App\Http\Requests;

use App\Models\ManifestoRodoLacre;
use Illuminate\Foundation\Http\FormRequest;

class RodoLacreStoreFormRequest extends FormRequest
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
            'manifesto_id' => ['required', 'integer','min:1'],
            'numero' => ['required', 'max:20', 'min:1',
                function ($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        if (!is_null($this->request->get('manifesto_id')))
                        {
                            $find = ManifestoRodoLacre::
                                where('manifesto_id', $this->request->get('manifesto_id'))
                                ->where('numero', $value)
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
            'numero' => 'Número'
        ];
    }
}
