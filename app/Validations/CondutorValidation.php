<?php

namespace App\Validations;

use App\Http\Requests\CondutorStoreFormRequest;

class CondutorValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new CondutorStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
