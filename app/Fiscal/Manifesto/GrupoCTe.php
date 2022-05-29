<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoCTe extends Grupo
{
    public static function load($make, $query)
    {
        foreach ($query->ctes as $n) {
            $std = new \stdClass();
            $std->chCTe = $n->chave;
            $std->SegCodBarra = '';
            $std->nItem = 0;
            $make->taginfCTe($std);
        }
    }
}
