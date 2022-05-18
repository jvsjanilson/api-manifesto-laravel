<?php

namespace App\Http\Controllers;

use App\Http\Requests\CteStoreFormRequest;
use Illuminate\Http\Request;
use App\Repositories\CteRepository;

class ManifestoCteController extends Controller
{
    private $repository;

    public function __construct(CteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CteStoreFormRequest $request)
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
