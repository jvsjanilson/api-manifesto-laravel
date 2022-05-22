<?php

namespace App\Validations;

use App\Http\Requests\SeguroStoreFormRequest;

class SeguroValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new SeguroStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
