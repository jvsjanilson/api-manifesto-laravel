<?php

namespace App\Http\Controllers;

use App\Http\Requests\CiotStoreFormRequest;
use App\Repositories\CiotRepository;
use Illuminate\Http\Request;

class ManifestoCiotController extends Controller
{

    private $repository;

    public function __construct(CiotRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CiotStoreFormRequest $request)
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
