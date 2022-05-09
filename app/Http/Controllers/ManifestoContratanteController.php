<?php

namespace App\Http\Controllers;

use App\Repositories\ContratanteRepository;
use Illuminate\Http\Request;

class ManifestoContratanteController extends Controller
{
    private $repository;

    public function __construct(ContratanteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
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
