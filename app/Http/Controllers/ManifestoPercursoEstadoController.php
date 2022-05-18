<?php

namespace App\Http\Controllers;

use App\Http\Requests\PercursoEstadoStoreFormRequest;
use App\Repositories\PercursoEstadoRepository;
use Illuminate\Http\Request;

class ManifestoPercursoEstadoController extends Controller
{
    private $repository;

    public function __construct(PercursoEstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(PercursoEstadoStoreFormRequest $request)
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
