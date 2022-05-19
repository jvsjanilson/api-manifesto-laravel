<?php

namespace App\Repositories;

use App\Models\ManifestoCiot;

class CiotRepository extends Repository
{
    public function __construct(ManifestoCiot $model)
    {
        parent::__construct($model);
    }
}
