<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoCiot
{
    public static function load($make, $manifesto)
    {
        if ($manifesto->modal == 1) {
            foreach ($manifesto->ciots as $c) {
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
