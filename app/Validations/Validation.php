<?php

namespace App\Validations;

use Illuminate\Http\Request;

class Validation
{
    public static function validacoes(Request $request)
    {
        $validationData = $request->all();
        new CondutorValidation($validationData['condutores']);

        if (isset($validationData['contratantes']))
            new ContratanteValidation($validationData['contratantes']);

        if (isset($validationData['ciots']))
            new CiotValidation($validationData['ciots']);

        if (isset($validationData['autorizacaos']))
            new AutorizacaoValidation($validationData['autorizacaos']);

        if (isset($validationData['ctes']))
            new CteValidation($validationData['ctes']);

        if (isset($validationData['lacres']))
            new LacreValidation($validationData['lacres']);

        if (isset($validationData['municipios_carregamento']))
            new MunicipioCarregamentoValidation($validationData['municipios_carregamento']);

        if (isset($validationData['municipios_descarregamento']))
            new MunicipioDescarregamentoValidation($validationData['municipios_descarregamento']);

        if (isset($validationData['nfes']))
            new NfeValidation($validationData['nfes']);

        if (isset($validationData['pedagios']))
            new PedagioValidation($validationData['pedagios']);

        if (isset($validationData['percuro_estados']))
            new PercursoEstadoValidation($validationData['percuro_estados']);

        if (isset($validationData['produto_predominante']))
            new ProdutoPredominanteValidation($validationData['produto_predominante']);

        if (isset($validationData['reboques']))
            new ReboqueValidation($validationData['reboques']);
    }
}

