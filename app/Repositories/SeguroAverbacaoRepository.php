<?php

namespace App\Repositories;

use App\Models\ManifestoSeguroAverbacao;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'manifesto_seguro_id', 'numero');
        try {
            $create = $this->model->create($data);
            return response()->json($create,Response::HTTP_CREATED );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

    }
}
