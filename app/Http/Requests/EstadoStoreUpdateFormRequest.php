<?php

namespace App\Http\Requests;

use App\Models\Estado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\RuleUnique;

class EstadoStoreUpdateFormRequest extends FormRequest
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
            'nome' => [Rule::requiredIf(is_null($this->route('estado'))),'max:120'],
            'uf' => [
                Rule::requiredIf(is_null($this->route('estado'))),
                new RuleUnique(new Estado, $this->route('estado'))
            ],
            'cod_ibge'=> [
                Rule::requiredIf(is_null($this->route('estado'))),
                new RuleUnique(new Estado, $this->route('estado'))
            ],
            'pais_id' => [Rule::requiredIf(is_null($this->route('estado')))],
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome do estado',
            'cod_ibge' => 'Cod. IBGE',
            'pais_id' => 'Pais',
        ];
    }
}
