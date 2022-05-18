<?php

namespace App\Repositories;

use App\Models\ManifestoPercursoEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PercursoEstadoRepository extends Repository
{
    public function __construct(ManifestoPercursoEstado $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(), [
            'manifesto_id' => 'required',
            'estado_id' => 'required',
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'created' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'estado_id');

        $find = $this->model->where('estado_id', $data['estado_id'])
            ->where('manifesto_id', $data['manifesto_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Estado já lançado'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $create = $this->model->create($data);
            return response()->json(
                $this->model->join('estados', 'manifesto_percurso_estados.estado_id', '=', 'estados.id')
                    ->select('estados.uf', 'manifesto_percurso_estados.id')
                    ->find($create->id)
                ,
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
