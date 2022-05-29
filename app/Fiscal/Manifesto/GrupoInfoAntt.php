<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoInfoAntt extends Grupo
{
    public static function load($make, $query)
    {
        if ($query->modal == 1) {
            if (!is_null($query->veiculoTracao->vtracao_rntrc) && $query->veiculoTracao->vtracao_rntrc>0){
                $infANTT = new \stdClass();
                $infANTT->RNTRC = $query->veiculoTracao->vtracao_rntrc;
                $make->taginfANTT($infANTT);
            }
        }
    }
}
