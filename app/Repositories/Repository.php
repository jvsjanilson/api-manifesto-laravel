<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

abstract class Repository {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $regs = $this->model
            ->paginate(config('app.paginate_number'));
        return response()->json($regs);
    }

    public function show($id)
    {
        try {
            $reg = $this->model->find($id);

            if (!isset($reg)) {
                return response()->json(['message'=> 'Registro não encontrado'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($reg, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'message'=> $e->getMessage()
                ]
                ,Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $created = $this->model->create($data);
            return response()->json($created,Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        try {
            $updated = $this->model->find($id);
            if (!isset($updated)) {
                return response()->json(['message'=> 'Registro não encontrado.'], Response::HTTP_NOT_FOUND);
            }
            $updated->update($data);
            return response()->json($updated, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => $e->getCode(),
                    'message'=> $e->getMessage()
                ]
                ,Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy($id)
    {
        $reg = $this->model->find($id);

        if ( !isset($reg)) {
            return response()->json(
                [
                    'message'=> 'Registro não encontrado.',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        try {
            $reg->delete();
            return response()->json(
                    [
                        'message'=> 'Removido com sucesso.',
                    ],
                    Response::HTTP_OK
                );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message'=> env('APP_DEBUG') == true ? 'Error ao deletar: ' . $e->getMessage() : 'Error ao deletar',

                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

}
