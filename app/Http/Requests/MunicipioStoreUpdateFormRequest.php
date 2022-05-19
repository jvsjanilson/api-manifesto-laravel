<?php

namespace App\Http\Requests;

use App\Models\Municipio;
use App\Rules\RuleUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MunicipioStoreUpdateFormRequest extends FormRequest
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
            'nome' => [Rule::requiredIf(is_null($this->route('municipio'))),'max:120'],

            'cod_ibge'=> [
                Rule::requiredIf(is_null($this->route('municipio'))),
                new RuleUnique(new Municipio(), $this->route('municipio'))
            ],
            'estado_id' => [Rule::requiredIf(is_null($this->route('municipio')))],

        ];
    }
}
