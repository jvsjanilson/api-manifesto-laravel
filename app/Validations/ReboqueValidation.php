<?php

namespace App\Validations;

use App\Http\Requests\ReboqueStoreFormRequest;

class ReboqueValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new ReboqueStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
