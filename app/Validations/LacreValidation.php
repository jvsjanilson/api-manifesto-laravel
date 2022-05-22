<?php

namespace App\Validations;

use App\Http\Requests\LacreStoreFormRequest;

class LacreValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new LacreStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
