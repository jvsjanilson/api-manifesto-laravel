<?php

namespace App\Repositories;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaRepository extends Repository
{
    public function __construct(Empresa $model)
    {
        parent::__construct($model);
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
