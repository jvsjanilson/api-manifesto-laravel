<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipioDescarregamentoStoreFormRequest;
use App\Repositories\MunicipioDescarregamentoRepository;
use Illuminate\Http\Request;

class ManifestoMunicipioDescarregamentoController extends Controller
{

    private $repository;

    public function __construct(MunicipioDescarregamentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(MunicipioDescarregamentoStoreFormRequest $request)
    {
        return $this->repository->store($request);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
