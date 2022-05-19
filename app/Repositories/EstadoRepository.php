<?php

namespace App\Repositories;

use App\Models\Estado;

class EstadoRepository extends Repository
{
    public function __construct(Estado $model)
    {
        parent::__construct($model);
    }
}
