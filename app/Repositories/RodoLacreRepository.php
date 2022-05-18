<?php

namespace App\Repositories;

use App\Models\ManifestoRodoLacre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RodoLacreRepository extends Repository
{
    public function __construct(ManifestoRodoLacre $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(), [
            'manifesto_id' => 'required',
            'numero' => ['required', 'max:20', 'min:1'],
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'created' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'numero');

        $find = $this->model
            ->where('manifesto_id', $data['manifesto_id'])
            ->where('numero', $data['numero'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Lacre já lançado'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $create = $this->model->create($data);
            return response()->json($create, Response::HTTP_CREATED );
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
