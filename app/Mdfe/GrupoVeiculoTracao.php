<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoVeiculoTracao
{

    /**
     * Condutores
     * @return Array
     */
    private static function grupoCondutor($manifesto)
    {
        $condutores = [];
        foreach ($manifesto->condutors as $c) {
            $condutor = new \stdClass();
            $condutor->xNome = $c->nome;
            $condutor->CPF = Funcoes::disFormatCPFCNPJ($c->cpf);
            array_push($condutores, $condutor);
        }
        return  $condutores;
    }

    public static function load($make, $manifesto)
    {

        if ($manifesto->modal == 1) {
            $veicTracao = new \stdClass();
            $veicTracao->cInt = $manifesto->veiculoTracao->vtracao_cint;//'01';
            $veicTracao->placa = $manifesto->veiculoTracao->vtracao_placa;//'DBL6040';
            $veicTracao->tara = $manifesto->veiculoTracao->vtracao_tara;//'8350';
            $veicTracao->capKG = $manifesto->veiculoTracao->vtracao_capkg;//'8350';
            $veicTracao->capM3 = $manifesto->veiculoTracao->vtracao_capm3;//'8350';
            $veicTracao->tpRod = str_pad($manifesto->veiculoTracao->vtracao_tprod,2, '00', STR_PAD_LEFT);//'03';
            $veicTracao->tpCar = str_pad($manifesto->veiculoTracao->vtracao_tpcar,2, '00', STR_PAD_LEFT);//'02';
            $veicTracao->UF = $manifesto->veiculoTracao->vtracao_uf;//'PA';

            $veicTracao->condutor = self::grupoCondutor($manifesto);

            if ($manifesto->veiculoTracao->vtracao_prop == 1)
            {
                $prop = new \stdClass();

                if (strlen($manifesto->veiculoTracao->vtracao_cpfcnpj) == 11)
                    $prop->CPF = Funcoes::disFormatCPFCNPJ($manifesto->veiculoTracao->vtracao_cpfcnpj);
                else
                    $prop->CNPJ = Funcoes::disFormatCPFCNPJ($manifesto->veiculoTracao->vtracao_cpfcnpj);

                $prop->RNTRC = $manifesto->veiculoTracao->vtracao_prop_rntrc;
                $prop->xNome = $manifesto->veiculoTracao->vtracao_prop_nome;
                $prop->IE = $manifesto->veiculoTracao->vtracao_prop_ie;
                $prop->UF = $manifesto->veiculoTracao->vtracao_prop_uf;
                $prop->tpProp = $manifesto->veiculoTracao->vtracao_prop_tpprop;
                $veicTracao->prop = $prop;
            }

            $make->tagveicTracao($veicTracao);
        }
    }
}
