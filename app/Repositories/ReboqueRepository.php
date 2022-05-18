<?php

namespace App\Repositories;

use App\Constantes\Limite;
use App\Models\ManifestoReboque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReboqueRepository extends Repository
{
    public function __construct(ManifestoReboque $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id',
            'reboque_codigo_veiculo',
            'reboque_placa',
            'reboque_renavam',
            'reboque_tara',
            'reboque_capkg',
            'reboque_capm3',
            'reboque_tpcar',
            'reboque_uf',
            'reboque_cod_agporto',
            'reboque_prop',
            'reboque_prop_cpfcnpj',
            'reboque_prop_rntrc',
            'reboque_prop_nome',
            'reboque_prop_ie',
            'reboque_prop_uf',
            'reboque_prop_tpprop'
        );

        $fieldValidation = [
            'reboque_prop' => 'required|integer',
            'reboque_placa' => 'required',
            'reboque_tara' => 'required|integer',
            'reboque_capkg' => 'required|integer',
            'manifesto_id' => 'required'
        ];

        if ($request->reboque_prop == 1) {
            $fieldValidation['reboque_prop_nome'] = 'required';
            $fieldValidation['reboque_prop_cpfcnpj'] = 'required';
        }

        $validationData = Validator::make($request->all(), $fieldValidation);

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($data['reboque_prop'] == 0) {
            $data['reboque_prop_cpfcnpj'] = '';
            $data['reboque_prop_rntrc'] = '0';
            $data['reboque_prop_nome'] = '';
            $data['reboque_prop_ie'] = '';
            $data['reboque_prop_uf'] = '';
            $data['reboque_prop_tpprop'] = '0';
        }

        $find = $this->model
            ->where('manifesto_id', $data['manifesto_id'])
            ->where('reboque_placa', $data['reboque_placa'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Reboque com a placa já lançado.'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $count = $this->model
            ->select(DB::raw('count(*) as total'))
            ->where('manifesto_id', $data['manifesto_id'])
            ->get()[0]['total'];

        if ($count >= Limite::NUMERO_MAXIMO_REBOQUE)
        {
            return response()->json(
                [
                    'msg' => 'Número máximo é ' . strval(Limite::NUMERO_MAXIMO_REBOQUE). '.'
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
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
