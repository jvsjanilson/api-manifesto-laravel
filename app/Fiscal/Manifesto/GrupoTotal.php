<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;
use App\Models\Funcoes;

class GrupoTotal extends Grupo
{
    public static function load($make, $query)
    {
        $std = new \stdClass();
        $std->vCarga = Funcoes::formatBrFloat($query->valor_carga);
        $std->cUnid = $query->cunid;
        $std->qCarga = Funcoes::formatBrFloat($query->quant_carga);
        $make->tagtot($std);
    }
}
