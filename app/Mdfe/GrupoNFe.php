<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoNFe
{
    public static function load($make, $manifesto)
    {
        foreach ($manifesto->nfes as $n) {
            $std = new \stdClass();
            $std->chNFe = $n->chave;
            $std->SegCodBarra = $n->segcodbarras;
            //$std->indReentrega = '0';
            $std->nItem = 0;
            $make->taginfNFe($std);
         }
    }
}
