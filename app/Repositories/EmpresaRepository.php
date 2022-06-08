<?php

namespace App\Repositories;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmpresaRepository extends Repository
{
    public function __construct(Empresa $model)
    {
        parent::__construct($model);
    }



    // public function store(Request $request)
    // {
    //     return parent::store($request);
    // }


    public function store(Request $request)
    {
        $data = $request->all();

        


        try {
            $created = $this->model->create($data);
            return response()->json($created,Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => env('APP_DEBUG') == true ? 'Error ao inserir: ' . $e->getMessage() : 'Error ao inserir'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function index()
    {
        $regs = $this->model
            ->select(
                    'empresas.id', 'empresas.nome', 'empresas.cnpj', 'estados.uf',
                    'municipios.nome as nome_municipio',
                    'ativo'
                )
            ->join('estados', 'estados.id', '=', 'empresas.estado_id')
            ->join('municipios', 'municipios.id', '=','empresas.municipio_id')
            ->paginate(config('app.paginate_number'));
        return response()->json($regs);
    }

}
