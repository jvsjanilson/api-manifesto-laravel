<?php

namespace App\Mdfe;

use App\Models\Funcoes;

class GrupoIde
{
    public static function load($make, $manifesto)
    {
        $std = new \stdClass;
        $std->cUF = $manifesto->empresa->estado->cod_ibge;
        $std->tpAmb = '2';
        $std->tpEmit = $manifesto->tipoemit;
        $std->tpTransp = Funcoes::tipoTransporte($manifesto->tipotransp);
        $std->mod = $manifesto->modelo;
        $std->serie = $manifesto->serie;
        $std->nMDF = 1;//$manifesto->numero;
        $std->cMDF = $manifesto->id; //'00025563';
        $std->cDV = '0';
        $std->modal = $manifesto->modal;
        $std->dhEmi = Date("Y-m-d\TH:i:sP");
        $std->tpEmis = '1'; //1-Normal, 2-contingencia
        $std->procEmi = '0';
        $std->verProc = '2022.1';
        $std->UFIni = $manifesto->ufini;
        $std->UFFim = $manifesto->uffim;
        // $std->dhIniViagem = '2019-04-23T06:00:48-03:00';
        // $std->indCanalVerde = '1';
        // $std->indCarregaPosterior = '1';
       // dd($std);
       $make->tagide($std);
    }
}
