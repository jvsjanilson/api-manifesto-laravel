<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaStoreUpdateFormRequest;
use App\Models\Empresa;
use App\Repositories\EmpresaRepository;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    private $repository;

    public function __construct(EmpresaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function empresas($email)
    {
        $empresas = Empresa::select('empresas.uuid','empresas.nome', 'empresas.cnpj','empresas.insc_estadual')
            ->join('user_empresas','user_empresas.empresa_id','=','empresas.id')
            ->join('users', 'users.id', '=','user_empresas.user_id')
            ->where('users.email', $email)
            ->get();
        return response()->json($empresas);

    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(EmpresaStoreUpdateFormRequest $request)
    {
        // if ( !is_null($request->file('certificado'))){
        //    $file =  $request->file('certificado');
        // }

        return $this->repository->store($request);
    }

    public function update(EmpresaStoreUpdateFormRequest $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
