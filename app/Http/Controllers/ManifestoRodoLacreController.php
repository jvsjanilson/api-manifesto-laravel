<?php

namespace App\Http\Controllers;

use App\Http\Requests\RodoLacreStoreFormRequest;
use App\Repositories\RodoLacreRepository;
use Illuminate\Http\Request;

class ManifestoRodoLacreController extends Controller
{
    private $repository;

    public function __construct(RodoLacreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(RodoLacreStoreFormRequest $request)
    {
        return $this->repository->store($request);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
