<?php


namespace App\Repositories;

use App\Models\ManifestoMunicipioDescarregamento;

class MunicipioDescarregamentoRepository extends Repository
{
    public function __construct(ManifestoMunicipioDescarregamento $model)
    {
        parent::__construct($model);
    }
}
