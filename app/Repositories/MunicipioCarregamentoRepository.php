<?php

namespace App\Repositories;

use App\Models\ManifestoMunicipioCarregamento;

class MunicipioCarregamentoRepository extends Repository
{
    public function __construct(ManifestoMunicipioCarregamento $model)
    {
        parent::__construct($model);
    }
}
