<?php

namespace App\Validations;

use App\Http\Requests\MunicipioCarregamentoStoreFormRequest;

class MunicipioCarregamentoValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new MunicipioCarregamentoStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
