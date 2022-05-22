<?php

namespace App\Validations;

use App\Http\Requests\ProdutoPredominanteStoreFormRequest;

class ProdutoPredominanteValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new ProdutoPredominanteStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
