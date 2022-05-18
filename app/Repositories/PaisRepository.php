<?php

namespace App\Repositories;

use App\Models\Pais;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaisRepository extends Repository
{
    public function __construct(Pais $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('nome', 'cod_ibge');
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
        $inputs = $request->only('nome','cod_ibge');

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
