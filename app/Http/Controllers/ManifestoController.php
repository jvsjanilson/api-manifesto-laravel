<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManifestoFormRequestStore;
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
        //dd(request()->header('Authorization'));
    }

    public function store(ManifestoFormRequestStore $request)
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
        //
    }
}
