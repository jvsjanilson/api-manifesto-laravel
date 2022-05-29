<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoLacre extends Grupo
{
    public static function load($make, $query)
    {
        if ($query->modal == 1) {
            foreach ($query->lacres as $l) {
                $std = new \stdClass();
                $std->nLacre = $l->numero;
                $make->taglacres($std);
            }
        }
    }
}
