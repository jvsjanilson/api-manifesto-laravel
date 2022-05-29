<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;
use App\Models\Funcoes;

class GrupoCiot extends Grupo
{
    public static function load($make, $query)
    {
        if ($query->modal == 1) {
            foreach ($query->ciots as $c) {
                $infCIOT = new \stdClass();
                $infCIOT->CIOT = $c->ciot;

                if (strlen($c->cpfcnpj) == 11) {
                    $infCIOT->CPF = Funcoes::disFormatCPFCNPJ($c->cpfcnpj);
                } else  {
                    $infCIOT->CNPJ = Funcoes::disFormatCPFCNPJ($c->cpfcnpj);
                }
                $make->taginfCIOT($infCIOT);
            }
        }
    }
}
