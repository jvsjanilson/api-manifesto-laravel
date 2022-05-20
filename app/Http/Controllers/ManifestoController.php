<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManifestoStoreFormRequest;
use App\Models\Manifesto;
use App\Repositories\ManifestoRepository;
use Illuminate\Http\Request;

class ManifestoController extends Controller
{

    private $repository;

    public function __construct(ManifestoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        //return response()->json(Manifesto::get());
        return $this->repository->index();
    }

    public function store(ManifestoStoreFormRequest $request)
    {
        return $this->repository->store($request);
    }

    public function show($id)
    {
        //
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
