<?php

namespace App\Repositories;

use App\Models\ManifestoAutorizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Constantes\Limite;
use App\Models\Funcoes;

class AutorizacaoDownloadRepository extends Repository
{
    public function __construct(ManifestoAutorizacao $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {

        $data = $request->only('manifesto_id', 'cpfcnpj');

        try {
            $create = $this->model->create($data);
            return response()->json(
                [
                    'created' => true,
                    'data' => $create
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'created' => false,
                    'msg' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

    }
}
