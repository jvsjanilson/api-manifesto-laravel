<?php

namespace App\Repositories;

use App\Models\Estado;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstadoRepository extends Repository
{
    public function __construct(Estado $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('nome', 'uf', 'pais_id', 'cod_ibge');
        try {
            $res = $this->model->create($data);
            return response()->json(['id'=> $res->id],Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'msg'=> $e->getMessage()
                ]
                ,Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->only('uf', 'nome', 'pais_id', 'id_ibge');

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
                ,Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
