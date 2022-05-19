<?php

namespace App\Repositories;

use App\Models\ManifestoAutorizacao;

class AutorizacaoDownloadRepository extends Repository
{
    public function __construct(ManifestoAutorizacao $model)
    {
        parent::__construct($model);
    }


}
