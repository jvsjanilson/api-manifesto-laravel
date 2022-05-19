<?php

namespace App\Repositories;

use App\Models\ManifestoRodoLacre;

class RodoLacreRepository extends Repository
{
    public function __construct(ManifestoRodoLacre $model)
    {
        parent::__construct($model);
    }
}
