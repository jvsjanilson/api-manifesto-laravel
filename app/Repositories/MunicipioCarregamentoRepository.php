<?php

namespace App\Repositories;

use App\Models\ManifestoMunicipioCarregamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Constantes\Limite;

class MunicipioCarregamentoRepository extends Repository
{
    public function __construct(ManifestoMunicipioCarregamento $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'estado_id', 'municipio_id');

        try {
            $create = $this->model->create($data);
            return response()->json($create
                // [
                //     'created' => true,
                //     'data' => $create
                // ]
                ,
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                [

                    'msg' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
