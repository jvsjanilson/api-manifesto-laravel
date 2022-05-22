<?php

namespace App\Validations;

use App\Http\Requests\NfeStoreFormRequest;

class NfeValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new NfeStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
