<?php

namespace App\Fiscal\Manifesto;

use App\Fiscal\Grupo;
use App\Models\Funcoes;

class GrupoIde extends Grupo
{
    public static function load($make, $query)
    {
        $std = new \stdClass;
        $std->cUF = $query->empresa->estado->cod_ibge;
        $std->tpAmb = '2';
        $std->tpEmit = $query->tipoemit;
        $std->tpTransp = Funcoes::tipoTransporte($query->tipotransp);
        $std->mod = $query->modelo;
        $std->serie = $query->serie;
        $std->nMDF = 1;//$query->numero;
        $std->cMDF = $query->id; //'00025563';
        $std->cDV = '0';
        $std->modal = $query->modal;
        $std->dhEmi = Date("Y-m-d\TH:i:sP");
        $std->tpEmis = '1'; //1-Normal, 2-contingencia
        $std->procEmi = '0';
        $std->verProc = '2022.1';
        $std->UFIni = $query->ufini;
        $std->UFFim = $query->uffim;
        // $std->dhIniViagem = '2019-04-23T06:00:48-03:00';
        // $std->indCanalVerde = '1';
        // $std->indCarregaPosterior = '1';
       // dd($std);
       $make->tagide($std);
    }
}
