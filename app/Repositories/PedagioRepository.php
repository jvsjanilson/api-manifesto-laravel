<?php

namespace App\Repositories;

use App\Models\ManifestoPedagio;
use Illuminate\Http\Request;
use App\Models\Funcoes;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class PedagioRepository extends Repository
{
    public function __construct(ManifestoPedagio $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'cnpj_fornecedor', 'numero_comprovante',
            'cpfcnpj_responsavel','valor_vale');

        try {
            $create = $this->model->create($data);
            return response()->json($create,Response::HTTP_CREATED);
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
