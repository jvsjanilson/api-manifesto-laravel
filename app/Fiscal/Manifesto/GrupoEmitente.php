<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;
use App\Models\Funcoes;

class GrupoEmitente extends Grupo
{
    public static function load($make, $query)
    {
        $std = new \stdClass();
        $std->CNPJ =  Funcoes::disFormatCPFCNPJ($query->empresa->cnpj) ;
        $std->IE = $query->empresa->insc_estadual;
        $std->xNome = $query->empresa->nome;
        $std->xFant = $query->empresa->nome;
        $make->tagemit($std);

        $std = new \stdClass();
        $std->xLgr = $query->empresa->endereco;
        $std->nro = $query->empresa->numero;
        $std->xBairro = $query->empresa->bairro;
        $std->cMun = $query->empresa->municipio->cod_ibge;
        $std->xMun = $query->empresa->municipio->nome;
        $std->CEP = Funcoes::disCEP($query->empresa->cep);
        $std->UF = $query->empresa->estado->uf;
        $std->fone = Funcoes::disTelefone($query->empresa->telefone);
        $std->email = $query->empresa->email;
        $make->tagenderEmit($std);
    }
}
