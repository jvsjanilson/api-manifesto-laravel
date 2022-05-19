<?php

namespace App\Repositories;

use App\Models\Municipio;

class MunicipioRepository extends Repository
{
    public function __construct(Municipio $model)
    {
        parent::__construct($model);
    }


}
