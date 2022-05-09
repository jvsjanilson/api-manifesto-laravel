<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

abstract class Repository {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function destroy($id)
    {
        $reg = $this->model->find($id);

        if ( !isset($reg)) {
            return response()->json(
                [
                    'msg'=> 'Registro não encontrado.',
                    'deleted' => false
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        try {
            $reg->delete();
            return response()->json(
                    [
                        'msg'=> 'Removido com sucesso.',
                        'deleted' => true
                    ],
                    Response::HTTP_OK
                );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'msg'=> env('APP_DEBUG') == true ? 'Error ao deletar: ' . $e->getMessage() : 'Error ao deletar',
                    'deleted' => false
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show($id)
    {
        try {
            $reg = $this->model->find($id);
            return response()->json($reg, Response::HTTP_OK);

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

    public function index()
    {
        $regs = $this->model
            ->paginate(config('app.paginate_number'));
        return response()->json($regs);
    }

}
