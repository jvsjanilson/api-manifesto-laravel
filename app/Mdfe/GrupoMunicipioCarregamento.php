<?php

namespace App\Mdfe;

class GrupoMunicipioCarregamento
{
    public static function load($make, $manifesto)
    {
        foreach ($manifesto->municipioscarregamento as $mc )
        {
            $infMunCarrega = new \stdClass();
            $infMunCarrega->cMunCarrega = $mc->municipio->cod_ibge;
            $infMunCarrega->xMunCarrega = $mc->municipio->nome;
            $make->taginfMunCarrega($infMunCarrega);
        }
    }
}
