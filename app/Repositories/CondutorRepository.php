<?php

namespace App\Repositories;

use App\Models\ManifestoCondutor;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Funcoes;
use App\Constantes\Limite;
use Illuminate\Http\Request;

class CondutorRepository extends Repository
{
    public function __construct(ManifestoCondutor $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {

        $data = $request->only('nome','cpf', 'manifesto_id');

        try {
            $create = $this->model->create($data);
            return response()->json(
                [
                    'inserted' => true,
                    'data' => $create
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'inserted' => false,
                    'msg' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
