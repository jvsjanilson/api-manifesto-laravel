<?php

namespace App\Repositories;

use App\Models\ManifestoSeguro;

class SeguroRepository extends Repository
{
    public function __construct(ManifestoSeguro $model)
    {
        parent::__construct($model);
    }
}

