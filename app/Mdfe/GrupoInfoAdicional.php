<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoInfoAdicional
{
    public static function load($make, $manifesto)
    {
        $std = new \stdClass();
        $std->infCpl = $manifesto->infocompl;
        $std->infAdFisco = $manifesto->infofisco;
        $make->taginfAdic($std);
    }
}
