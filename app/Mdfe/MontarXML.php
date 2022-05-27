<?php

namespace App\Mdfe;

use App\Models\Manifesto;

use NFePHP\MDFe\Make;


class MontarXML
{
    public static function montar($id)
    {
        $manifesto = Manifesto::find($id);
        $make = new Make();

        GrupoIde::load($make, $manifesto);
        GrupoEmitente::load($make, $manifesto);
        GrupoMunicipioCarregamento::load($make, $manifesto);
        GrupoPercursoEstado::load($make, $manifesto);
        GrupoInfoAntt::load($make, $manifesto);
        GrupoVeiculoTracao::load($make, $manifesto);
        GrupoCiot::load($make, $manifesto);
        GrupoPedagio::load($make, $manifesto);
        GrupoContratante::load($make, $manifesto);
        GrupoReboque::load($make, $manifesto);
        GrupoLacre::load($make, $manifesto);
        GrupoAutorizacaoXml::load($make, $manifesto);
        GrupoSeguro::load($make, $manifesto);
        GrupoInfoAdicional::load($make, $manifesto);
        GrupoTotal::load($make, $manifesto);
        dd($make);
        return $make;

    }
}
