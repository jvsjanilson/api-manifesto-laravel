<?php

namespace App\Repositories;

use App\Models\ManifestoSeguroAverbacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SeguroAverbacaoRepository extends Repository
{
    public function __construct(ManifestoSeguroAverbacao $model)
    {
        parent::__construct($model);
    }

    public function list($manifesto_id, $manifesto_seguro_id)
    {
        return response()->json(
            ManifestoSeguroAverbacao::select('numero')
            ->where('manifesto_id', $manifesto_id)
            ->where('manifesto_seguro_id', $manifesto_seguro_id)
            ->get()
        );
    }

    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(), [
            'manifesto_id' => 'required|integer',
            'numero' => 'required',
            'manifesto_seguro_id' => 'required|integer',
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'created' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'manifesto_seguro_id', 'numero');

        $find = $this->model
            ->where('manifesto_id', $data['manifesto_id'])
            ->where('manifesto_seguro_id', $data['manifesto_seguro_id'])
            ->where('numero', $data['numero'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Averbação já lançado'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        try {
            $create = $this->model->create($data);
            return response()->json(
                [
                    'created' => true,
                    'data' => $create
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'created' => false,
                    'msg' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }
}
