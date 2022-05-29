<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;
use App\Models\Funcoes;

class GrupoReboque extends Grupo
{
    public static function load($make, $query)
    {
        if ($query->modal == 1) {
            foreach ($query->reboques as $r) {

                $veicReboque = new \stdClass();
                $veicReboque->cInt = $r->reboque_codigo_veiculo; //'02';
                $veicReboque->placa = $r->reboque_placa;
                $veicReboque->tara = $r->reboque_tara;
                $veicReboque->capKG = $r->reboque_capkg;
                $veicReboque->tpCar = $r->reboque_tpcar;
                $veicReboque->UF = $r->reboque_uf;

                if ($r->reboque_prop == 1) {

                    $prop = new \stdClass();
                    if (strlen($r->reboque_prop_cpfcnpj) == 11) {
                        $prop->CPF = Funcoes::disFormatCPFCNPJ($r->reboque_prop_cpfcnpj);
                    } else {
                        $prop->CNPJ = Funcoes::disFormatCPFCNPJ($r->reboque_prop_cpfcnpj);
                    }
                    $prop->RNTRC = $r->reboque_prop_rntrc;
                    $prop->xNome = $r->reboque_prop_nome;
                    $prop->IE = $r->reboque_prop_ie;
                    $prop->UF = $r->reboque_prop_uf;
                    $prop->tpProp = $r->reboque_prop_tpprop;
                    $veicReboque->prop = $prop;
                }

                $make->tagveicReboque($veicReboque);
            }
        }
    }
}
