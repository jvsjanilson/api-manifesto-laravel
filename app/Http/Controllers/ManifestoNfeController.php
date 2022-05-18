<?php

namespace App\Http\Controllers;

use App\Http\Requests\NfeStoreFormRequest;
use App\Repositories\NfeRepository;
use Illuminate\Http\Request;

class ManifestoNfeController extends Controller
{
    private $repository;

    public function __construct(NfeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(NfeStoreFormRequest $request)
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
