<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoPercursoEstado extends Grupo
{
    public static function load($make, $query)
    {
        foreach ($query->percuroEstados as $p)
        {
            $infPercurso = new \stdClass();
            $infPercurso->UFPer = $p->estado->uf;
            $make->taginfPercurso($infPercurso);
        }
    }
}
