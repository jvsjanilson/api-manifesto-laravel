<?php

namespace App\Validations;

use App\Http\Requests\PercursoEstadoStoreFormRequest;

class PercursoEstadoValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new PercursoEstadoStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
