<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoMunicipioCarregamento extends Grupo
{
    public static function load($make, $query)
    {
        foreach ($query->municipioscarregamento as $mc )
        {
            $infMunCarrega = new \stdClass();
            $infMunCarrega->cMunCarrega = $mc->municipio->cod_ibge;
            $infMunCarrega->xMunCarrega = $mc->municipio->nome;
            $make->taginfMunCarrega($infMunCarrega);
        }
    }
}
