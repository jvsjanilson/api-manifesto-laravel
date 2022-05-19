<?php

namespace App\Repositories;

use App\Models\ManifestoLacre;

class LacreRepository extends Repository
{
    public function __construct(ManifestoLacre $model)
    {
        parent::__construct($model);
    }
}
