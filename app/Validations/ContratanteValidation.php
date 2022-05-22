<?php

namespace App\Validations;

use App\Http\Requests\ContratanteStoreFormRequest;

class ContratanteValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new ContratanteStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
