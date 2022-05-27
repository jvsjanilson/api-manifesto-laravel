<?php

namespace App\Mdfe;

class GrupoLacre
{
    public static function load($make, $manifesto)
    {
        if ($manifesto->modal == 1) {
            foreach ($manifesto->lacres as $l) {
                $std = new \stdClass();
                $std->nLacre = $l->numero;
                $make->taglacres($std);
            }
        }
    }
}
