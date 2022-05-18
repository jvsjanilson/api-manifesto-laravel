<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoPredominanteStoreFormRequest;
use App\Repositories\ProdutoPredominanteRepository;
use Illuminate\Http\Request;

class ManifestoProdutoPredominanteController extends Controller
{

    private $repository;

    public function __construct(ProdutoPredominanteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(ProdutoPredominanteStoreFormRequest $request)
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
