<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoInfoAdicional extends Grupo
{
    public static function load($make, $query)
    {
        $std = new \stdClass();
        $std->infCpl = $query->infocompl;
        $std->infAdFisco = $query->infofisco;
        $make->taginfAdic($std);
    }
}
