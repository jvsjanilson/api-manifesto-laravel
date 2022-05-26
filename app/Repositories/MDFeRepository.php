<?php

namespace App\Repositories;

use App\Models\Manifesto;

class MDFeRepository extends Repository
{

    public function __construct(Manifesto $model)
    {
        parent::__construct($model);
    }
    
    public function statusServico()
    {
        return response()->json(['message' => 'Status do Servico'],200);
    }

    public function enviar($id)
    {
        return response()->json(['message' => 'Enviar -> ' . $id],200);
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
