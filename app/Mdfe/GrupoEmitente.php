<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoEmitente
{
    public static function load($make, $manifesto)
    {
        $std = new \stdClass();
        $std->CNPJ =  Funcoes::disFormatCPFCNPJ($manifesto->empresa->cnpj) ;
        $std->IE = $manifesto->empresa->insc_estadual;
        $std->xNome = $manifesto->empresa->nome;
        $std->xFant = $manifesto->empresa->nome;
        $make->tagemit($std);

        $std = new \stdClass();
        $std->xLgr = $manifesto->empresa->endereco;
        $std->nro = $manifesto->empresa->numero;
        $std->xBairro = $manifesto->empresa->bairro;
        $std->cMun = $manifesto->empresa->municipio->cod_ibge;
        $std->xMun = $manifesto->empresa->municipio->nome;
        $std->CEP = Funcoes::disCEP($manifesto->empresa->cep);
        $std->UF = $manifesto->empresa->estado->uf;
        $std->fone = Funcoes::disTelefone($manifesto->empresa->telefone);
        $std->email = $manifesto->empresa->email;
        $make->tagenderEmit($std);
    }
}
