<?php

namespace App\Repositories;

use App\Models\ManifestoRodoLacre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RodoLacreRepository extends Repository
{
    public function __construct(ManifestoRodoLacre $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'numero');

        try {
            $create = $this->model->create($data);
            return response()->json($create, Response::HTTP_CREATED );
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
