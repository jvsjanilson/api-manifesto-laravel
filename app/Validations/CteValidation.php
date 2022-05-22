<?php

namespace App\Validations;

use App\Http\Requests\CteStoreFormRequest;

class CteValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new CteStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
