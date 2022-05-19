<?php

namespace App\Repositories;

use App\Models\Pais;

class PaisRepository extends Repository
{
    public function __construct(Pais $model)
    {
        parent::__construct($model);
    }
}
