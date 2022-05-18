<?php

namespace App\Repositories;

use App\Models\ManifestoNfe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Constantes\Limite;
use Illuminate\Support\Facades\DB;


class NfeRepository extends Repository
{

    public function __construct(ManifestoNfe $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'chave', 'municipio_id', 'segcodbarras');

        try {
            $create = $this->model->create($data);
            return response()->json(
                $this->model->select('manifesto_nfes.id', 'manifesto_nfes.chave',
                        'manifesto_nfes.segcodbarras',
                        'municipios.nome'
                    )
                    ->join('municipios', 'manifesto_nfes.municipio_id', '=', 'municipios.id')
                    ->find($create->id)
                ,
                Response::HTTP_CREATED
            );
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
