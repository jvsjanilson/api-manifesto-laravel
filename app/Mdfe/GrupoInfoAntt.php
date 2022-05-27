<?php

namespace App\Mdfe;

class GrupoInfoAntt
{
    public static function load($make, $manifesto)
    {
        if ($manifesto->modal == 1) {
            if (!is_null($manifesto->veiculoTracao->vtracao_rntrc) && $manifesto->veiculoTracao->vtracao_rntrc>0){
                $infANTT = new \stdClass();
                $infANTT->RNTRC = $manifesto->veiculoTracao->vtracao_rntrc;
                $make->taginfANTT($infANTT);
            }
        }
    }
}
