<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;
use App\Models\Funcoes;

class GrupoVeiculoTracao extends Grupo
{

    /**
     * Condutores
     * @return Array
     */
    private static function grupoCondutor($query)
    {
        $condutores = [];
        foreach ($query->condutors as $c) {
            $condutor = new \stdClass();
            $condutor->xNome = $c->nome;
            $condutor->CPF = Funcoes::disFormatCPFCNPJ($c->cpf);
            array_push($condutores, $condutor);
        }
        return  $condutores;
    }

    public static function load($make, $query)
    {

        if ($query->modal == 1) {
            $veicTracao = new \stdClass();
            $veicTracao->cInt = $query->veiculoTracao->vtracao_cint;//'01';
            $veicTracao->placa = $query->veiculoTracao->vtracao_placa;//'DBL6040';
            $veicTracao->tara = $query->veiculoTracao->vtracao_tara;//'8350';
            $veicTracao->capKG = $query->veiculoTracao->vtracao_capkg;//'8350';
            $veicTracao->capM3 = $query->veiculoTracao->vtracao_capm3;//'8350';
            $veicTracao->tpRod = str_pad($query->veiculoTracao->vtracao_tprod,2, '00', STR_PAD_LEFT);//'03';
            $veicTracao->tpCar = str_pad($query->veiculoTracao->vtracao_tpcar,2, '00', STR_PAD_LEFT);//'02';
            $veicTracao->UF = $query->veiculoTracao->vtracao_uf;//'PA';

            $veicTracao->condutor = self::grupoCondutor($query);

            if ($query->veiculoTracao->vtracao_prop == 1)
            {
                $prop = new \stdClass();

                if (strlen($query->veiculoTracao->vtracao_cpfcnpj) == 11)
                    $prop->CPF = Funcoes::disFormatCPFCNPJ($query->veiculoTracao->vtracao_cpfcnpj);
                else
                    $prop->CNPJ = Funcoes::disFormatCPFCNPJ($query->veiculoTracao->vtracao_cpfcnpj);

                $prop->RNTRC = $query->veiculoTracao->vtracao_prop_rntrc;
                $prop->xNome = $query->veiculoTracao->vtracao_prop_nome;
                $prop->IE = $query->veiculoTracao->vtracao_prop_ie;
                $prop->UF = $query->veiculoTracao->vtracao_prop_uf;
                $prop->tpProp = $query->veiculoTracao->vtracao_prop_tpprop;
                $veicTracao->prop = $prop;
            }

            $make->tagveicTracao($veicTracao);
        }
    }
}
