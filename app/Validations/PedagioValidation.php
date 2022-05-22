<?php

namespace App\Validations;


use App\Http\Requests\PedagioStoreFormRequest;

class PedagioValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new PedagioStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
