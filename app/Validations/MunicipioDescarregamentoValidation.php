<?php

namespace App\Validations;

use App\Http\Requests\MunicipioDescarregamentoStoreFormRequest;

class MunicipioDescarregamentoValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new MunicipioDescarregamentoStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
