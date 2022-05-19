<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadoStoreUpdateFormRequest;
use App\Repositories\EstadoRepository;

use Illuminate\Http\Request;

class EstadoController extends Controller
{

    private $repository;

    public function __construct(EstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(EstadoStoreUpdateFormRequest $request)
    {
        return $this->repository->store($request);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update(EstadoStoreUpdateFormRequest $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
