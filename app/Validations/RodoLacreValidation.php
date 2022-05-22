<?php

namespace App\Validations;

use App\Http\Requests\RodoLacreStoreFormRequest;

class RodoLacreValidation
{
    public function __construct($value)
    {
        $this->valida($value);
    }

    private function valida($values) {
        foreach ($values as $value) {
            $valida = new RodoLacreStoreFormRequest($value);
            $valida->validate($valida->rules());
        }
    }
}
