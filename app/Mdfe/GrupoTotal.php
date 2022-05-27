<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoTotal
{
    public static function load($make, $manifesto)
    {
        $std = new \stdClass();
        $std->vCarga = Funcoes::formatBrFloat($manifesto->valor_carga);
        $std->cUnid = $manifesto->cunid;
        $std->qCarga = Funcoes::formatBrFloat($manifesto->quant_carga);
        $make->tagtot($std);
    }
}
