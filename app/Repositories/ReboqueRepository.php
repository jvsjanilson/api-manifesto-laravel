<?php

namespace App\Repositories;

use App\Models\ManifestoReboque;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReboqueRepository extends Repository
{
    public function __construct(ManifestoReboque $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->all();

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
