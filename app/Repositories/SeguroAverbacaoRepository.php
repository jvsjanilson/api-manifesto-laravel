<?php

namespace App\Repositories;

use App\Models\ManifestoSeguroAverbacao;

class SeguroAverbacaoRepository extends Repository
{
    public function __construct(ManifestoSeguroAverbacao $model)
    {
        parent::__construct($model);
    }

    public function list($manifesto_id, $manifesto_seguro_id)
    {
        return response()->json(
            ManifestoSeguroAverbacao::select('numero')
            ->where('manifesto_id', $manifesto_id)
            ->where('manifesto_seguro_id', $manifesto_seguro_id)
            ->get()
        );
    }
}
