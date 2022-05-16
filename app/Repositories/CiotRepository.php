<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\ManifestoCiot;
use Illuminate\Support\Facades\Validator;
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

        $find = $this->model->where('ciot', $data['ciot'])
            ->where('manifesto_id', $data['manifesto_id'])
            ->first();

        if (isset($find)) {
            return response()->json(
                [
                    'msg' => 'Ciot já lançado'
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
