<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoNFe extends Grupo
{
    public static function load($make, $query)
    {
        foreach ($query->nfes as $n) {
            $std = new \stdClass();
            $std->chNFe = $n->chave;
            $std->SegCodBarra = $n->segcodbarras;
            //$std->indReentrega = '0';
            $std->nItem = 0;
            $make->taginfNFe($std);
         }
    }
}
