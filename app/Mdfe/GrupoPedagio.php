<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoPedagio
{
    public static function load($make, $manifesto)
    {
        if ($manifesto->modal == 1) {
            foreach ($manifesto->pedagios as $p) {
                $valePed = new \stdClass();
                $valePed->CNPJForn = Funcoes::disFormatCPFCNPJ($p->cnpj_fornecedor);

                if (strlen($p->cpfcnpj_responsavel) == 11)
                {
                    $valePed->CPFPg = Funcoes::disFormatCPFCNPJ($p->cpfcnpj_responsavel);
                } else {
                    $valePed->CNPJPg = Funcoes::disFormatCPFCNPJ($p->cpfcnpj_responsavel);
                }

                $valePed->nCompra = $p->numero_comprovante;
                $valePed->vValePed = Funcoes::formatBrFloat($p->valor_vale);
                $make->tagdisp($valePed);
            }
        }

    }
}
