<?php

namespace App\Repositories;

use App\Models\ManifestoAutorizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Constantes\Limite;
use App\Models\Funcoes;

class AutorizacaoRepository extends Repository
{
    public function __construct(ManifestoAutorizacao $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {

        $validationData = Validator::make($request->all(), [
            'cpfcnpj' => 'required',
            'manifesto_id' => 'required'
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'cpfcnpj');

        $find = $this->model->where('cpfcnpj', Funcoes::disFormatCPFCNPJ($data['cpfcnpj']))
            ->where('manifesto_id', $data['manifesto_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'CPF/CNPJ já lançado'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        $count = $this->model->select(DB::raw('count(*) as total'))
            ->where('manifesto_id', $data['manifesto_id'])
            ->get()[0]['total'];

        if ($count >= Limite::NUMERO_MAXIMO_AUTORIZACAO_DOWNLOAD)
        {
            return response()->json(
                [
                    'msg' => 'Número máximo é ' . strval(Limite::NUMERO_MAXIMO_AUTORIZACAO_DOWNLOAD). '.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        try {
            $create = $this->model->create($data);
            return response()->json(
                [
                    'inserted' => true,
                    'data' => $create
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'inserted' => false,
                    'msg' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }
}
