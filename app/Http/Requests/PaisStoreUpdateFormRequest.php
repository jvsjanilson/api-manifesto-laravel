<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaisStoreUpdateFormRequest extends FormRequest
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
            'nome' => [ Rule::requiredIf(is_null($this->route('paise'))), 'max:120'],
            'cod_ibge' => [
                'unique:pais,cod_ibge,id',
                Rule::requiredIf(is_null($this->route('paise')))
            ],
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome do país',
            'cod_ibge' => 'Cod. IBGE',
        ];
    }
}
