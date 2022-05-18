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
        $data = $request->only('manifesto_id', 'estado_id');

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
