<?php

namespace App\Repositories;

use App\Models\ManifestoLacre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LacreRepository extends Repository
{
    public function __construct(ManifestoLacre $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'numero');

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
