<?php

namespace App\Mdfe;

use App\Models\Funcoes;
use App\Models\ManifestoSeguroAverbacao;

class GrupoSeguro
{
    public static function load($make, $manifesto)
    {

        foreach ($manifesto->seguros as $s) {
            $std = new \stdClass();
            $std->respSeg = $s->resp_seg;
            $std->CNPJ = Funcoes::disFormatCPFCNPJ($s->cpfcnpj);

            $stdinfSeg = new \stdClass();
            $stdinfSeg->xSeg = $s->nome_seguradora;
            $stdinfSeg->CNPJ = Funcoes::disFormatCPFCNPJ($s->cnpj_seguradora);
            $std->infSeg = $stdinfSeg;
            $std->nApol = $s->numero_apolice;

            $aAverbs = [];

            $averbacoes = ManifestoSeguroAverbacao::where('manifesto_id', $manifesto->id)
                ->where('manifesto_seguro_id', $s->id)
                ->get();

            foreach ($averbacoes as $avb) {
                array_push($aAverbs,$avb->numero);
            }

            $std->nAver = $aAverbs;
            $make->tagseg($std);
        }
    }
}
