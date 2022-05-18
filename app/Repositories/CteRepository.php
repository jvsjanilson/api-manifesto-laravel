<?php

namespace App\Repositories;

use App\Models\ManifestoCte;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CteRepository extends Repository
{
    public function __construct(ManifestoCte $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'chave', 'municipio_id', 'segcodbarras');

        try {
            $create = $this->model->create($data);
            return response()->json(
                $this->model->select('manifesto_ctes.id', 'manifesto_ctes.chave',
                        'manifesto_ctes.segcodbarras',
                        'municipios.nome'
                    )
                    ->join('municipios', 'manifesto_ctes.municipio_id', '=', 'municipios.id')
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
