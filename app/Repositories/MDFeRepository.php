<?php

namespace App\Repositories;

use App\Fiscal\Manifesto\ManifestoUtil;
use App\Models\Manifesto;

use App\Utils\ConfigTools;

class MDFeRepository extends Repository
{

    public function __construct(Manifesto $model)
    {
        parent::__construct($model);
    }

    public function statusServico($empresa)
    {
        return ConfigTools::statusServico($empresa);
    }

    public function envia($id)
    {
        try {

            ManifestoUtil::envia($id);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),501);
        }
        //return response()->json(['message' => 'Enviar -> ' . $id],200);
    }

    public function damdfe($id)
    {
       return response()->json(['message' => 'DAMDFe -> ' . $id],200);
    }

    public function encerra($id)
    {
        return response()->json(['message' => 'Encerrar -> ' . $id],200);
    }

    public function cancela($id)
    {
        return response()->json(['message' => 'Cancelar -> ' . $id],200);
    }

}
