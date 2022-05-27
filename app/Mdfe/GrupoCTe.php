<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoCTe
{
    public static function load($make, $manifesto)
    {
        foreach ($manifesto->ctes as $n) {
            $std = new \stdClass();
            $std->chCTe = $n->chave;
            $std->SegCodBarra = '';
            $std->nItem = 0;
            $make->taginfCTe($std);
        }
    }
}
