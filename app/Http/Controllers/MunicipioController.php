<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipioStoreUpdateFormRequest;
use App\Repositories\MunicipioRepository;
use Illuminate\Http\Request;


class MunicipioController extends Controller
{
    private $repository;

    public function __construct(MunicipioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(MunicipioStoreUpdateFormRequest $request)
    {
        return $this->repository->store($request);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update(MunicipioStoreUpdateFormRequest $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
