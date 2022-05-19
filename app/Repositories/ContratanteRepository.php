<?php

namespace App\Repositories;

use App\Models\ManifestoContratante;

class ContratanteRepository extends Repository
{
    public function __construct(ManifestoContratante $model)
    {
        parent::__construct($model);
    }
}
