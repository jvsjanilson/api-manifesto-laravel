<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;

class GrupoProdutoPredominante extends Grupo
{
    public static function load($make, $query)
    {

        if (!is_null($query->prodpred)) {

            $prodPred = new \stdClass();
            $prodPred->tpCarga = $query->prodpred->tpcarga;
            $prodPred->xProd = $query->prodpred->xprod;
            $prodPred->cEAN = $query->prodpred->cean;
            $prodPred->NCM = $query->prodpred->ncm;

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
