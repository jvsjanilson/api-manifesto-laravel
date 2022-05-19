<?php

namespace App\Repositories;

use App\Models\ManifestoCondutor;

class CondutorRepository extends Repository
{
    public function __construct(ManifestoCondutor $model)
    {
        parent::__construct($model);
    }
}
