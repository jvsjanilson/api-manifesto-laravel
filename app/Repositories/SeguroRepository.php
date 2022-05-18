<?php

namespace App\Repositories;

use App\Models\ManifestoSeguro;
use App\Models\Funcoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class SeguroRepository extends Repository
{
    public function __construct(ManifestoSeguro $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $fieldValidation = [
            'manifesto_id' => 'required',
            'resp_seg' => 'required',
        ];

        if ( strval( $request->resp_seg) == 2)
        {
            $fieldValidation = [
                'manifesto_id' => 'required',
                'resp_seg' => 'required',
                'cpfcnpj' => 'required',
                'nome_seguradora' => 'required',
                'cnpj_seguradora' => 'required',
                'numero_apolice' => 'required',
            ];
        }

        $validationData = Validator::make($request->all(), $fieldValidation);

        if ($validationData->fails()) {
            return response()->json([
                'created' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only('manifesto_id', 'resp_seg', 'cpfcnpj','nome_seguradora',
        'cnpj_seguradora','numero_apolice');

        if (!isset($data['numero_apolice'])) {
            $data['numero_apolice'] = '';
        }
        if (!isset($data['cpfcnpj'])) {
            $data['cpfcnpj'] = '';
        }

        $find = $this->model->
            where('manifesto_id', $data['manifesto_id'])
            ->where('numero_apolice', $data['numero_apolice'])
            ->where('cpfcnpj', Funcoes::disFormatCPFCNPJ($data['cpfcnpj']))
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Número apolice já lançado.'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {

            $create = $this->model->create($data);
            return response()->json($create, Response::HTTP_CREATED);
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

