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
    public function store(Request $request)
    {
        $validationData = Validator::make($request->all(),
        [
            'nome' => ['required', 'max:60', 'min:2'],
            'cnpj' => 'required',
        ],

        [
            // 'required' => 'O :attribute é obrigatório',
        ],
        [
            'nome' => 'Nome',
            'cnpj' => 'CNPJ'
        ]
        );

        if ($validationData->fails()) {
            return response()->json([
                'inserted' => false,
                'msg' => 'Erro de validação',
                'errors' =>  $validationData->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        return parent::store($request);
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
