<?php

namespace App\Repositories;

use App\Models\ManifestoSeguro;
use App\Models\Funcoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class SeguroRepository extends Repository
{
    public function __construct(ManifestoSeguro $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'resp_seg', 'cpfcnpj','nome_seguradora',
        'cnpj_seguradora','numero_apolice');

        try {

            $create = $this->model->create($data);
            return response()->json($create, Response::HTTP_CREATED);
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

