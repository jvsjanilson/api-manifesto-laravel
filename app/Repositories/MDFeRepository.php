<?php

namespace App\Repositories;

use App\Mdfe\MontarXML;
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

    public function enviar($id)
    {
        MontarXML::montar($id);
        //return response()->json(['message' => 'Enviar -> ' . $id],200);
    }

    public function damdfe($id)
    {
       return response()->json(['message' => 'DAMDFe -> ' . $id],200);
    }

    public function encerrar($id)
    {
        return response()->json(['message' => 'Encerrar -> ' . $id],200);
    }

    public function cancelar($id)
    {
        return response()->json(['message' => 'Cancelar -> ' . $id],200);
    }

}
