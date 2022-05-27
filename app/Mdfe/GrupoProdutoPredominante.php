<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoProdutoPredominante
{
    public static function load($make, $manifesto)
    {

        if (!is_null($manifesto->prodpred)) {

            $prodPred = new \stdClass();
            $prodPred->tpCarga = $manifesto->prodpred->tpcarga;
            $prodPred->xProd = $manifesto->prodpred->xprod;
            $prodPred->cEAN = $manifesto->prodpred->cean;
            $prodPred->NCM = $manifesto->prodpred->ncm;

            //campos obrigatorios
            $localCarrega = new \stdClass();
            $localCarrega->CEP = '00000000';
            $localCarrega->latitude = null;
            $localCarrega->longitude = null;

            $localDescarrega = new \stdClass();
            $localDescarrega->CEP = '00000000';
            $localDescarrega->latitude = null;
            $localDescarrega->longitude = null;

            $lotacao = new \stdClass();
            $lotacao->infLocalCarrega = $localCarrega;
            $lotacao->infLocalDescarrega = $localDescarrega;

            $prodPred->infLotacao = $lotacao;


            $make->tagprodPred($prodPred);
        } else {
            return ['message' => 'Informe o produto predominante.'];
        }
    }
}
