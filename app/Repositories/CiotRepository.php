<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\ManifestoCiot;
use Symfony\Component\HttpFoundation\Response;

class CiotRepository extends Repository
{
    public function __construct(ManifestoCiot $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'ciot', 'cpfcnpj');

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
