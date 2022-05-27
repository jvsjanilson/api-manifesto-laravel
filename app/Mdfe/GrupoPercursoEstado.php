<?php

namespace App\Mdfe;

class GrupoPercursoEstado
{
    public static function load($make, $manifesto)
    {
        foreach ($manifesto->percuroEstados as $p)
        {
            $infPercurso = new \stdClass();
            $infPercurso->UFPer = $p->estado->uf;
            $make->taginfPercurso($infPercurso);
        }
    }
}
