<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaisStoreUpdateFormRequest;
use App\Repositories\PaisRepository;
use Illuminate\Http\Request;

class PaisController extends Controller
{

    private $repository;

    public function __construct(PaisRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(PaisStoreUpdateFormRequest $request)
    {
        return $this->repository->store($request);
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update(PaisStoreUpdateFormRequest $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
