<?php

namespace App\Repositories;

use App\Models\ManifestoPedagio;

class PedagioRepository extends Repository
{
    public function __construct(ManifestoPedagio $model)
    {
        parent::__construct($model);
    }
}
