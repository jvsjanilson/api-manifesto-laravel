<?php

namespace App\Validations;

use Illuminate\Http\Request;

class Validation
{
    public static function validacoes(Request $request)
    {
        $validationData = $request->all();
        new CondutorValidation($validationData['condutores']);

        isset($validationData['contratantes']) ? new ContratanteValidation($validationData['contratantes']) : null;
        isset($validationData['ciots']) ? new CiotValidation($validationData['ciots']) : null;
        isset($validationData['autorizacaos']) ? new AutorizacaoValidation($validationData['autorizacaos']) : null;
        isset($validationData['ctes']) ? new CteValidation($validationData['ctes']) : null;
        isset($validationData['lacres']) ? new LacreValidation($validationData['lacres']) : null;
        isset($validationData['municipios_carregamento']) ? new MunicipioCarregamentoValidation($validationData['municipios_carregamento']) : null;
        isset($validationData['municipios_descarregamento']) ? new MunicipioDescarregamentoValidation($validationData['municipios_descarregamento']) : null;
        isset($validationData['nfes']) ? new NfeValidation($validationData['nfes']) : null;
        isset($validationData['pedagios']) ? new PedagioValidation($validationData['pedagios']) : null;
        isset($validationData['percuro_estados']) ? new PercursoEstadoValidation($validationData['percuro_estados']) : null;
        isset($validationData['produto_predominante']) ? new ProdutoPredominanteValidation($validationData['produto_predominante']) : null;
        isset($validationData['reboques']) ? new ReboqueValidation($validationData['reboques']) : null;
        isset($validationData['rodo_lacres']) ? new RodoLacreValidation($validationData['rodo_lacres']) : null;
        isset($validationData['seguros']) ? new SeguroValidation($validationData['seguros']) : null;
    }
}

