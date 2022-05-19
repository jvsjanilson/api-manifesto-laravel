<?php

namespace App\Repositories;

use App\Models\Pais;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaisRepository extends Repository
{
    public function __construct(Pais $model)
    {
        parent::__construct($model);
    }
}
