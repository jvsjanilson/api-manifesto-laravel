<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoContratante
{
    public static function load($make, $manifesto)
    {
        if ($manifesto->modal == 1) {
            foreach ($manifesto->contratantes as $c) {
                $infContratante = new \stdClass();
                $infContratante->CNPJ = Funcoes::disFormatCPFCNPJ($c->cpfcnpj);
                $make->taginfContratante($infContratante);
            }
        }
    }
}
