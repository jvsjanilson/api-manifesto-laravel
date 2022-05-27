<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoAutorizacaoXml
{
    public static function load($make, $manifesto)
    {
        foreach ($manifesto->autorizacaos as $a) {
            $std = new \stdClass();
            $std->CNPJ = Funcoes::disFormatCPFCNPJ($a->cpfcnpj);
            $make->tagautXML($std);
        }
    }
}
