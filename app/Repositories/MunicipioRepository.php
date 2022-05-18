<?php

namespace App\Repositories;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MunicipioRepository extends Repository
{
    public function __construct(Municipio $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('nome', 'estado_id', 'capital', 'cod_ibge');
        try {
            $res = $this->model->create($data);
            return response()->json(['id'=> $res->id],Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'msg'=> $e->getMessage()
                ]
                ,Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->only('nome', 'capital', 'estado_id', 'cod_ibge');

        try {
            $reg = $this->model->find($id);
            $reg->update($inputs);
            return response()->json(['msg' => 'Atualizado com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'msg'=> $e->getMessage()
                ]
                ,Response::HTTP_BAD_REQUEST
            );
        }
    }
}
