<?php

namespace App\Repositories;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MunicipioRepository extends Repository
{
    public function __construct(Municipio $model)
    {
        parent::__construct($model);
    }


}
