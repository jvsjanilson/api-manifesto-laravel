<?php

namespace App\Repositories;

use App\Models\ManifestoContratante;
use App\Models\Funcoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ContratanteRepository extends Repository
{
    public function __construct(ManifestoContratante $model)
    {
        parent::__construct($model);
    }


    public function store(Request $request)
    {
        $data = $request->only('manifesto_id', 'cpfcnpj');

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
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
