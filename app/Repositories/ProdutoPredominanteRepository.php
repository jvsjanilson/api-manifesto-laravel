<?php

namespace App\Repositories;

use App\Constantes\Limite;
use Illuminate\Http\Request;
use App\Models\ManifestoProdutoPredominante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProdutoPredominanteRepository extends Repository
{
    public function __construct(ManifestoProdutoPredominante $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id','tpcarga', 'cean', 'ncm','xprod');
 

        $find = $this->model->where('xprod', $data['xprod'])
            ->where('manifesto_id', $data['manifesto_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Produto já lançado.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        $count = $this->model->select(DB::raw('count(*) as total'))
            ->where('manifesto_id', $data['manifesto_id'])
            ->get()[0]['total'];

        if ($count >= Limite::NUMERO_MAXIMO_PRODUTOPREDOMINANTE)
        {
            return response()->json(
                [
                    'msg' => 'Número máximo é ' . strval(Limite::NUMERO_MAXIMO_PRODUTOPREDOMINANTE). '.'
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
