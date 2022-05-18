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
        $data = $request->only('manifesto_id', 'reboque_codigo_veiculo', 'reboque_placa', 'reboque_renavam',
            'reboque_tara', 'reboque_capkg', 'reboque_capm3', 'reboque_tpcar', 'reboque_uf', 'reboque_cod_agporto',
            'reboque_prop', 'reboque_prop_cpfcnpj', 'reboque_prop_rntrc', 'reboque_prop_nome', 'reboque_prop_ie',
            'reboque_prop_uf', 'reboque_prop_tpprop'
        );

        if ($data['reboque_prop'] == 0) {
            $data['reboque_prop_cpfcnpj'] = '';
            $data['reboque_prop_rntrc'] = '0';
            $data['reboque_prop_nome'] = '';
            $data['reboque_prop_ie'] = '';
            $data['reboque_prop_uf'] = '';
            $data['reboque_prop_tpprop'] = '0';
        }

        try {
            $create = $this->model->create($data);
            return response()->json($create, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
