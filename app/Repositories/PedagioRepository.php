<?php

namespace App\Repositories;

use App\Models\ManifestoPedagio;
use Illuminate\Http\Request;
use App\Models\Funcoes;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class PedagioRepository extends Repository
{
    public function __construct(ManifestoPedagio $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(), [
            'numero_comprovante' => 'required|integer',
            'cnpj_fornecedor' => 'required',
            'manifesto_id' => 'required'
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'created' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'cnpj_fornecedor', 'numero_comprovante',
            'cpfcnpj_responsavel','valor_vale');

        $find = $this->model->where('manifesto_id', $data['manifesto_id'])
            ->where('cnpj_fornecedor', Funcoes::disFormatCPFCNPJ($data['cnpj_fornecedor']))
            ->where('numero_comprovante', $data['numero_comprovante'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Registro já lançado'
                ],
                Response::HTTP_BAD_REQUEST
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
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
