<?php

namespace App\Validations;

use App\Http\Requests\CiotStoreFormRequest;

class CiotValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new CiotStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
