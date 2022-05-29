<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

use App\Models\Funcoes;

class GrupoContratante extends Grupo
{
    public static function load($make, $query)
    {
        if ($query->modal == 1) {
            foreach ($query->contratantes as $c) {
                $infContratante = new \stdClass();
                $infContratante->CNPJ = Funcoes::disFormatCPFCNPJ($c->cpfcnpj);
                $make->taginfContratante($infContratante);
            }
        }
    }
}
