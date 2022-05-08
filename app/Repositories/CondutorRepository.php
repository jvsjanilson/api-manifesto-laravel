<?php

namespace App\Repositories;

use App\Models\ManifestoCondutor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Funcoes;
use App\Constantes\Limite;
use Illuminate\Http\Request;

class CondutorRepository extends Repository
{
    public function __construct(ManifestoCondutor $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(), [
            'manifesto_id' => 'required',
            'nome' => 'required',
            'cpf' => 'required',
        ]);

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('nome','cpf', 'manifesto_id');


        $find = $this->model->where('cpf', Funcoes::disFormatCPFCNPJ($data['cpf']))
            ->where('manifesto_id', $data['manifesto_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'CPF já lançado'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $count = $this->model->select(DB::raw('count(*) as total'))
            ->where('manifesto_id', $data['manifesto_id'])
            ->get()[0]['total'];

        if ($count >= Limite::NUMERO_MAXIMO_CONDUTOR)
        {
            return response()->json(
                [
                    'msg' => 'Número máximo é ' .strval(Limite::NUMERO_MAXIMO_CONDUTOR) . '.'
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
