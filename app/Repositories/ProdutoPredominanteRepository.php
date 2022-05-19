<?php

namespace App\Repositories;

use App\Models\ManifestoProdutoPredominante;

class ProdutoPredominanteRepository extends Repository
{
    public function __construct(ManifestoProdutoPredominante $model)
    {
        parent::__construct($model);
    }
}
