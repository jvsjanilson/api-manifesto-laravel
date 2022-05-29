<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;
use App\Models\Funcoes;

class GrupoAutorizacaoXml extends Grupo
{
    public static function load($make, $query)
    {
        foreach ($query->autorizacaos as $a) {
            $std = new \stdClass();
            $std->CNPJ = Funcoes::disFormatCPFCNPJ($a->cpfcnpj);
            $make->tagautXML($std);
        }
    }
}
