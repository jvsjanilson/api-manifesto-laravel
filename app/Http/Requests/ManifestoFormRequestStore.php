<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManifestoFormRequestStore extends FormRequest
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
            'ufini' => 'required|string|max:2',
            'uffim' => 'required|string|max:2',
            'tipoemit' => 'required|integer',
            'tipotransp' => 'required|integer',
            'modal' => 'required|integer',
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
}
